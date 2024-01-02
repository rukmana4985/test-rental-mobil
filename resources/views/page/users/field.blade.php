<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="text" name="username" value="{{ @$data->username }}">
            <label>Nama</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="number" name="phone" value="{{ @$data->phone }}">
            <label>Kontak</label>
        </div>
        {{-- <div class="form-body form-group form-md-line-input"> --}}
            {{-- {!! Template::selectbox($listRole,@$data->role_id,'role_id',['class' => 'form-control']) !!} --}}
            <input type="hidden" name="role_id" id="" value="2">
            {{-- <label>Jabatan</label> --}}
        {{-- </div> --}}
        <div class="form-body form-group form-md-line-input">
            <input class="form-control" type="number" name="sim" value="{{ @$data->sim }}">
            <label>SIM</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <textarea name="address" id="" cols="30" rows="10" class="form-control">{{ @$data->address }}</textarea>
            <label>Alamat</label>
        </div>
    </div>
</div>
<button class="btn green" type="submit">Save</button>
<button class="btn red"> Cancel </button>
