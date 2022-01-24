@extends('dashboard.index')
@section('content')

<div class="container">
    @if($errors->any())
    <h4 class="text-dark bg-warning">{{$errors->first()}}</h4>
    @endif
    <div class="row">
        <div class="col-md-6 bg-light py-2 shadow-lg rounded">
            <select  class="form-control my-1" id="user_type">
                <option value="2">{{ __('lang.all') }}</option>
                <option value="1">{{ __('lang.users') }}</option>
                <option value="0">{{ __('lang.vendors') }}</option>
            </select>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text p-2">{{ __('lang.title') }}</span>
                </div>
                <input type="text" name="" id="not_title" class="form-control solid_required">

            </div>
            <div class="form-group py-2">
                <textarea class="form-control solid_required" name="" id="not_body" cols="30" rows="10" placeholder="{{ __('lang.content') }}"></textarea>
            </div>
            <div class="btn btn-dark text-dark" onclick="addFormUpdate()">{{ __('lang.notifyAll') }}</div>
            
        </div>
    </div>
</div>
<script>
    function addFormUpdate() {
            let ok = false ;
            $( ".solid_required" ).each(function() {
                if($(this).val() == "" || $(this).val() == null)
                {
                    $(this).addClass('validate');
                    $(this).next('.msg').remove();
                    $(this).after(`<label class="msg" >{{ __("lang.requiredfield")}}</label>`);
                    ok = true ;
                }else {
                    $(this).next('.msg').remove();
                    $(this).removeClass('validate');
                }
            });

            if(ok)
            {
                return ;
            }
           
            $(".btn-primary").attr("disabled", true);

            let fd = {
                _token: '{{ csrf_token() }}',
                title: $('#not_title').val(),
                body: $('#not_body').val(),
                type:$('#user_type').val(),
                
            }
            $.ajax({
                url: "notify-all",
                method: 'POST',
                data: fd,
                success: function(res) {
                    $(".btn-primary").removeAttr("disabled");
                    $(".add-new-data").removeClass("show");
                    $(".overlay-bg").removeClass("show");
                    $("#data-name, #data-price").val("");
                    $("#data-category, #data-status").prop("selectedIndex", 0);
                    $("#category-table").DataTable().ajax.reload();
                    if(res.code == "200"){
                        $("#category-table").DataTable().ajax.reload();
                        Swal.fire({
                            title:"{{ __('lang.success') }}",
                            text:"{{ __('lang.success') }}",
                            type:"success",
                            confirmButtonClass:"btn btn-primary",
                            buttonsStyling:!1
                        });
                        
                        $('#not_title').val("");
                        $('#not_body').val("");
                    }else{
                        $(".btn-primary").removeAttr("disabled");
                        Swal.fire({
                            title:"{{ __('lang.error') }}",
                            text:"{{ __('lang.error') }}",
                            type:"error",
                            confirmButtonClass:"btn btn-primary",
                            buttonsStyling:!1
                        });
                    }
                },
                error: function(res) {
                    // console.log(res);
                    $(".btn-primary").removeAttr("disabled");
                    alert("{{ __('lang.fillall')}}");
                }
            })
        }
</script>
@endsection

