<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <div class="form-body form-group form-md-line-input">
                {!! Template::selectbox($listUser,@$data->user_id,'user_id',['class' => 'form-control select']) !!}
                <label>Pemilik</label>
            </div>
        </div>      
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="plat" value="{{ @$data->plat }}">
            <label>Plat</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="merk" value="{{ @$data->merk }}">
            <label>Merk</label>
        </div>  
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="model" value="{{ @$data->model }}">
            <label>Model</label>
        </div>      
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="number" name="tarif" value="{{ @$data->tarif }}">
            <label>Tarif</label>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
