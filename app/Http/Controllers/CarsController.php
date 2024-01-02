<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;

use App\Models\Car;
use App\Models\UserAll;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator, Alert;

class CarsController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Car $main_model){
        $this->view         = 'cars';
        $this->title        = 'Mobil';
        $this->main_model   = $main_model;
        $this->validate     = 'CarRequest';

        $listUser        = UserAll::where('role_id', '=', '2')->pluck('username','id');
        View::share('listUser', $listUser);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {
        $datas = $this->main_model->with(['user'])->select(['*'])->orderBy('created_at','desc');     
        $columns = [
            'plat',
            'user.username',
            'merk',
            'model',
            'tarif',
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
                    if($data->status == "S")
                    {
                        $q = "<span class='badge badge-warning'>Sedang Disewakan</span>";
                    }
                    else {
                        $q = "<span class='badge badge-success'>Tersedia</span>";
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

    public function store(CarRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data = $this->main_model->create($input);
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

    public function update(CarRequest $request, $id)
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
