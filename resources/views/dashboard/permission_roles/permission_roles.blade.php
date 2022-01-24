@extends('dashboard.index')
@section('content')
{{-- @dd($vednors) --}}

{{-- <div class="row">
    <div class="col-md-6">
        <select class="form-control"  onchange="filterReviews(this.value)">
            <option value="" >{{ __('lang.all') }}</option>
            @foreach ($vendors as $item)
                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary bg-warning text-warning rounded" onclick="reset()">{{ __('lang.reset') }}</button>

</div> --}}
<section>
    <section id="data-thumb-view" class="data-thumb-view-header">

        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">

                <div class="btn-group dropdown actions-dropodown">
                </div>
            </div>
        </div>
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table id="sliders-table" class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>{{trans('lang.permission_name')}}</th>
                        {{-- <th>{{trans('lang.permission_guard_name')}}</th> --}}
                        @foreach($roles as $role)
                            <th>{{$role->name}}</th>
                        @endforeach
                        
                    </tr>
                </thead>

            </table>
        </div>
        <!-- dataTable ends -->

        <!-- add new sidebar starts -->
         <div class="add-new-data-sidebar" >
            <div class="overlay-bg" id="overlay-bg"></div>
            <div class="add-new-data" id="addCategory" >
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">{{ __('lang.roles') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3" style="overflow : hidden">
                    <div class="data-fields px-2 mt-3" >
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="add-name">{{ __('lang.role_name') }}</label>
                                <input type="text"  class="form-control solid_required" id="add-role_name">
                            </div>
                            
                        </div>


                    </div>
                </div>



                <div class="add-data-footer d-flex justify-content-around px-3 mt-2 row">
                    <div class="add-data-btn col-md-6 text-center align-self-center">
                        <button class="btn btn-primary"  onclick="addFormUpdate()">{{ __('lang.data') }}</button>
                    </div>
                    <div class="cancel-data-btn col-md-6 text-center align-self-center">
                        <button class="btn btn-outline-danger">{{ __('lang.cancle') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new sidebar ends -->


        <!-- edit sidebar starts -->
        <div class="add-new-data-sidebar">
            <div id="addoverlay-bg" class="overlay-bg"></div>
            <div id="ddadd-new-data" class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">{{ __('lang.reviews') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="edit-card_number">{{ __('lang.role_name') }}</label>
                                <input type="text" class="form-control solid_up_required" id="edit-role_name">

                            </div>
                          

                            <input type="hidden" id="edit-role_id" name="edit_product_option_id">


                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-info" onclick="updateFormUpdate()">{{ __('lang.update') }}</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger ml-3">{{ __('lang.cancle') }}</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- add new sidebar ends -->
    </section>

     {{-- delete modal --}}
     <div class="modal" id="deleteModal">
        <div class="modal-dialog" >
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-danger" >
                    <h4 class="modal-title " >
                        <div id="model">{{ __('lang.delete') }}</div>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        {{-- <form action="#" method="POST"> --}}
                            {{-- {{ csrf_field() }} --}}
                            <input type="hidden"  id="delete-city_id" >
                            <div class="form-group ">
                                {{ __('lang.areyousuretodelete') }}  : <p id="group_title"></p>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class=" btn  btn-primary " onclick="deleteFormUpdate()">{{ __('lang.delete') }}</button>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- delete PetShop Image modal --}}
    <div class="modal" id="deleteVetShopImage">
        <div class="modal-dialog" >
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-danger" >
                    <h4 class="modal-title " >
                        <div id="model">{{ __('lang.delete') }}</div>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        {{-- <form action="#" method="POST"> --}}
                            {{ csrf_field() }}
                            <input type="hidden"  id="vett_id" >
                            <input type="hidden"  id="dvetImage_id" >

                            <div class="form-group ">
                                {{ __('lang.areyousuretodelete') }}  : <p id="dpet_name"></p>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class=" btn  btn-primary " onclick="deleteVetShopImage()">{{ __('lang.delete') }}</button>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

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
                role_name: $('#add-role_name').val(),
               
            }
        $.ajax({
            url: "add-role",
            method: 'POST',
            data: fd,
            success: function(res) {
                $(".btn-primary").removeAttr("disabled");
                $(".add-new-data").removeClass("show");
                $(".overlay-bg").removeClass("show");
                $("#data-name, #data-price").val("");
                $("#data-category, #data-status").prop("selectedIndex", 0);
                $("#group-table").DataTable().ajax.reload();
                if(res.code == "200"){
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $('#add-description').val("");
                    $('#parent').val(0);
                    $('#imageVal').val("");
                    $('#is_market').val(0);
                    $('#add-name').val("");
                    $('#group-id').val("");
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
                $("#sliders-table").DataTable().ajax.reload();
            },
            error: function(res) {
                $(".btn-primary").removeAttr("disabled");
                alert("{{ __('lang.fillall')}}");
            }
        })
    }
    function updateFormUpdate() {
        // alert($("#product-id").val());
        let ok = false ;
        $( ".solid_up_required" ).each(function() {
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

        let fd = {
            _token: '{{ csrf_token() }}',
            role_id: $("#edit-role_id").val(),
            role_name: $("#edit-role_name").val(),     
        }

        $.ajax({
            url: "edit-roles",
            method: 'post',
            data: fd,

            success: function(res) {
                $("#group-table").DataTable().ajax.reload();
                 if(res.code == 200){
                    // alert("done");
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1

                    });
                    $("#addoverlay-bg").removeClass("show");
                    $("#ddadd-new-data").removeClass("show");
                }else{

                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"{{ __('lang.error') }}",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                }
                $("#sliders-table").DataTable().ajax.reload();
            }
        })
    }
    function deleteFormUpdate() {
        let fd = {
            _token: '{{ csrf_token() }}',
            role_id: $('#delete-city_id').val(),
        }

        $.ajax({
            url: "delete-roles",
            method: 'delete',
            data: fd,
            success: function(res) {
                $('#deleteModal').modal('hide');
                if(res.code == 200){

                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });

                }else{
                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                }
                $("#sliders-table").DataTable().ajax.reload();
            }
        })
    }



   
    //////////////////////////////
    
    var roles;
    function get_roles(){
        $.ajax({
            url: "/get-all_roles",
            method: 'get',
            success: function(res) {
                roles = res.roles;
                console.log(roles);
                init_table();   
            }
        });
    }
    $(document).ready(function() {
        
        get_roles();
        // renderiCheck('sliders-table');
    });
    function init_table(){
        var columns = [
            { "data": "permission_name" },
            // { "data": "gaurd_name" }
        ];
        for(let role in roles){
            columns.push({"data": roles[role].name});
        }
        $('#sliders-table').DataTable(
            {
                lengthMenu: [
                    [ 10, 25, 50, 100, 250, 500, 1000, 2000, 5000],
                    [ 10, 25, 50, 100, 250, 500, 1000, 2000, 5000]
                ],
                pageLength: 10,
                buttons: [
                   
                    {
                        "extend": "csv",
                        "text": "Excel",
                        "filename": " permissions",
                        "className": "btn btn-warning bg-warning rounded ml-1",
                        "charset": "utf-8",
                        "bom": "true",
                        init: function(api, node, config) {
                            $(node).removeClass("btn-default");
                        },
                        exportOptions: {
                            columns: ':not(:first-child)',
                            }
                    }
                ],
                processing: true,
                serverSide: true,
                paging: true,
                    "ajax": "{{url('/all-permissions')}}",
                    "columns": columns
            }
            );
        }
    function editNews(id,name){
        $("#edit-role_id").val(unescape(id));
        $("#edit-role_name").val(unescape(name));
        $("#addoverlay-bg").addClass("show");
        $("#ddadd-new-data").addClass("show");

    }
    function deleteNews(id){
        $("#deleteModal").modal('show');
        $("#delete-city_id").val(id);
    }
    function clsrImageID(imgID){
        return imgID;
    }
    $(document).ready(function() {
       Dropzone.autoDiscover = false;
        $("#my-awesome-dropzone").dropzone({
        init: function() {
            myDropzone = this;
            $.ajax({
            url: 'uploads',
            type: 'post',
            data: {request: 2},
            dataType: 'json',
            success: function(response){

                $.each(response, function(key,value) {
                var mockFile = { name: value.name, size: value.size };

                myDropzone.emit("addedfile", mockFile);
                myDropzone.emit("thumbnail", mockFile, value.path);
                myDropzone.emit("complete", mockFile);

                });

            }
            });
        }
        });
    });
    function removePetShopImage(vetID,vetImageID){

        $('#vett_id').val(vetID);
        $('#dvetImage_id').val(vetImageID);
        $("#deleteVetShopImage").modal('show');

    }
    function deleteVetShopImage(){
        let category_id= $('#vett_id').val()  ;
        let dvetImage_id= $('#dvetImage_id').val()  ;
        let fd = {
            _token: '{{ csrf_token() }}',
            category_id: category_id,
            dvetImage_id: dvetImage_id
        }
        $.ajax({
            url: "delete-category-image",
            method: 'post',
            data: fd,
            success: function(res) {
                $('#deleteVetShopImage').modal('hide');
                if(res == "1"){
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $("#ddadd-new-data").removeClass('show');
                }else{
                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                }
                $("#user-table").DataTable().ajax.reload();
            }
        })
    }
    function reset(){
        location.reload();
    }
    function assignRole(roleId, permission, status){
        var url = "";
        if (status == 0) {
            url = "{{url('permissions/revoke-permission-to-role')}}";
        } else {
            url = "{{url('permissions/give-permission-to-role')}}";
        }
        $.ajax({
            method: "POST",
            url: url,
            data: {_token: "{{csrf_token()}}", roleId: roleId, permission: permission}
        })
        .done(function (msg) {
            console.log(msg);
            if (status == 0) {
                $("#permibbb"+permission+roleId).attr("onclick","assignRole('"+roleId+"','"+permission+"',1)");
            } else {
                $("#permibbb"+permission+roleId).attr("onclick","assignRole('"+roleId+"','"+permission+"',0)");
            }
        });

            
    }
</script>
@endsection
