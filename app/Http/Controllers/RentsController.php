<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RentRequest;

use App\Models\Car;
use App\Models\Rent;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator, Alert;

class RentsController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Rent $main_model){
        $this->view         = 'rents';
        $this->title        = 'Sewa Mobil';
        $this->main_model   = $main_model;
        $this->validate     = 'RentRequest';

        $listCar        = Car::where('status', '!=', 'S')->pluck('plat','id');
        View::share('listCar', $listCar);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $datas = $this->main_model->with(['car'])->select(['*'])->orderBy('created_at','desc');     
        $columns = [
            'date_start',
            'date_end',
            'lama_sewa',
            'car.plat',
            'car.merk',
            'car.model',
            'price',
            'status',
            'action'
        ];
   
        if($request->ajax())
        {
            return Datatables::of($datas)
                ->addColumn('action',function($data){
                        return view('page.'.$this->view.'.action',compact('data'));
                })
                ->addColumn('status',function($data){
                    // status = S :sewa  K : Tersedia
                    if($data->car->status == "S")
                    {
                        $q = "<span class='badge badge-warning'>Sedang Disewakan</span>";
                    }
                    else {
                        $q = "<span class='badge badge-success'>Sudah Dibayar</span>";
                    }
                    return $q;
                
                })
                ->escapeColumns(['actions'])
                ->make(true);
        }
        return view('page.'.$this->view.'.index')
            ->with(compact('datas','columns'));

    }

    public function create()
    {
        $validator = JsValidator::formRequest('App\Http\Requests\\'.$this->validate);
        return view('page.'.$this->view.'.create')->with(compact('validator'));
    }

    public function store(RentRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view); 
            $input['status'] = "S";         
            $data = $this->main_model->create($input);
            
            $car = Car::findOrFail($input['car_id']);
            $input_detail['status'] = $data->status;
            $car->fill($input_detail)->save();
            
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil ditambahkan!');
            General::setImage($request->file('image'),$data->id,$this->view);
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());     
            DB::rollback();
        }

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->main_model->findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\\'.$this->validate);
        return view('page.'.$this->view.'.edit')->with(compact('validator','data'));
    }

    public function update(RentRequest $request, $id)
    {
        $input = $request->all();
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data->fill($input)->save();
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil diubah!');
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());           
            DB::rollback();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = $this->main_model->findOrFail($id);
        DB::beginTransaction();
        try{
            $data->delete();
            DB::commit();
            Alert::success('Berhasil', 'Data berhasil dihapus!');
            return redirect()->route($this->view.'.index');
        }catch(\Exception $e) {
            DB::rollback();
        }
        Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());  
        return redirect()->back();
    }

}
