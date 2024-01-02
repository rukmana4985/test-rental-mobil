<div class="row">
    <div class="col-md-6 ">
        <div class="form-body form-group form-md-line-input">
            <div class="form-body form-group form-md-line-input">
                {!! Template::selectbox($listCar,@$data->car_id,'car_id',['class' => 'form-control select car']) !!}
                <label>Mobil</label>
            </div>
        </div>      
        <div class="form-body form-group form-md-line-input">
            <input class="form-control date_start" id="date_start" type="date" name="date_start" value="{{ @$data->date_start }}">
            <label>Tanggal Mulai</label>
        </div>
        <div class="form-body form-group form-md-line-input">
            <input class="form-control date_end" id="date_end" type="date" name="date_end" value="{{ @$data->date_end }}">
            <label>Tanggal Berakhir</label>
        </div>  
        <div class="form-body form-group form-md-line-input">
            <input class="form-control lama_sewa" id="lama_sewa" type="text" readonly name="lama_sewa" value="{{ @$data->lama_sewa }}">
            <label>Lama Sewa/Hari</label>
        </div> 
        <div class="form-body form-group form-md-line-input">
            <input class="form-control tarif" id="tarif" type="text" readonly name="harga_sewa" value="{{ @$data->car->tarif }}">
            <label>Harga Sewa/Hari</label>
        </div>      
        <div class="form-body form-group form-md-line-input">
            <input class="form-control price" id="price" type="number" readonly name="price" value="{{ @$data->price }}">
            <label>Harga Sewa</label>
        </div>
    </div>
</div>
<button class="btn green bt" type="submit">Save</button>
<button class="btn red"> Cancel </button>

@section('js')
    <script>
        $(document).ready(function(){
            $("body").on('change','.car', function(){
                var index       = $(this).index(".car");
                var car_id     = $(this).val();
                
                $( "#tarif" ).eq(index).val(0);
                if(car_id > 0)
                {
                    var url = "{{ url('api/cars') }}"+"/"+car_id;
                    $.get( url, function( data ) {
                        if(data.data.tarif > 0)
                        {
                            $("#tarif").eq(index).val(data.data.tarif);
                            
                        }
                    }, "json" );
                }
            });

            $("body").on('change','#date_end', function(){
                
                var date = new Date($('#date_start').val());
                var date1 = new Date($('#date_end').val());
                day = date.getDate();
                day1 = date1.getDate();
                var calcs = day1-day;
                $('#lama_sewa').val(calcs);
                var count_price  = $('#tarif').val() * $('#lama_sewa').val();
                $('#price').val(count_price);
               
            });
            
        })
    </script>
@endsection