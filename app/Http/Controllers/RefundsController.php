<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RefundRequest;

use App\Models\Refund;
use App\Models\Car;

use App\Traits\ImagesTrait;
use Yajra\DataTables\Facades\DataTables;
use DB,General,View,JsValidator, Alert;

class RefundsController extends Controller
{
    use ImagesTrait;

    public $view;
    public $main_model;

    public function __construct(Refund $main_model){
        $this->view         = 'refunds';
        $this->title        = 'Pengembalian';
        $this->main_model   = $main_model;
        $this->validate     = 'RefundRequest';

        // $listUser        = UserAll::where('role_id', '=', '2')->pluck('username','id');
        // View::share('listUser', $listUser);
        View::share('view', $this->view);
        View::share('title', $this->title);
    }

    public function index(Request $request)
    {   
        $datas = $this->main_model->with(['car'])->select(['*'])->orderBy('created_at','desc');     
        $columns = [
            'payment_date',
            'car.plat',
            'status'
        ];
   
        if($request->ajax())
        {
            return Datatables::of($datas)
                ->addColumn('status',function($data){
                   if($data->car->status == "K")
                   {
                        $q= "Sudah dibayar";
                   }
                   else 
                   {
                        $q= "Belum dibayar";
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

    public function store(RefundRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            $input['image'] = General::setImage($request->file('image'),$this->view);            
            $data = $this->main_model->create($input);
            $car    = Car::findOrFail($data->car_id);
            $input_detail['status'] = "K";
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

    public function update(RefundRequest $request, $id)
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

    public function search(Request $request)
    {
        $search = $request->search;
        $cars   = Car::where('plat', 'like', "%".$search."%")->get();
        return view('page.'.$this->view.'.list')->with(compact('cars'));
    }

    // public function payment(RefundRequest $request, $id)
    // {
    //     $input = $request->all();
    //     $data = $this->main_model->findOrFail($id);
    //     DB::beginTransaction();
    //     try{
    //         $input['image'] = General::setImage($request->file('image'),$this->view);            
    //         $data->fill($input)->save();

    //         DB::commit();
    //         Alert::success('Berhasil', 'Pembayaran Berhasil!');
    //         return redirect()->route($this->view.'.index');
    //     }catch(\Exception $e) {
    //         Alert::error('Terjadi Kesalahan yaitu ',$e->getMessage());           
    //         DB::rollback();
    //     }
    //     return redirect()->back();
    // }
}
