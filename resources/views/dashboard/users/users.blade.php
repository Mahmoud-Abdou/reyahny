{{-- @dd(session()->get('lang')) --}}
@extends('dashboard.index')
@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
    #deleteMark{
        font-size: 15px;
    }
</style>

<section>
    <section id="data-thumb-view" class="data-thumb-view-header">

        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">

                <div class="btn-group dropdown actions-dropodown">
                    <div class="dropdown-menu dropdown-menu-right ">
                        <a class="dropdown-item" onclick="openoffermodal()"><i class="feather icon-package"></i>{{ __('lang.addtooffer') }}</a>
                        <input type="hidden" name="ids" id="prod_id">
                    </div>
                </div>
            </div>
        </div>
       
        <!-- dataTable starts -->
        <div class="row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">{{ __('lang.roles') }}</span>
                    </div>
                    <select name=""  class="form-control" onchange="inittable(this.value)">
                        <option value="user">user</option>  
                        @foreach ($roles as $key => $role)
                            <option value="{{$key}}">{{$key}}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="products-table" class="table data-thumb-view">
                <thead>
                    <tr>
                        
                        @can("users.c.name")<th>{{ __('lang.name') }}</th>@endcan
                        @can("users.c.image")<th>{{ __('lang.image') }}</th>@endcan
                        @can("users.c.phone")<th>{{ __('lang.phone') }}</th>@endcan
                        @can("users.c.city")<th>{{ __('lang.city') }}</th>@endcan
                        @can("users.c.town")<th>{{ __('lang.town') }}</th>@endcan
                        @can("users.c.action")<th>#</th>@endcan
                    </tr>
                </thead>

            </table>
        </div>
        <!-- dataTable ends -->

      <!-- add new sidebar starts -->
<div class="add-new-data-sidebar">
    <div class="overlay-bg" id="overlay-bg"></div>
    <div class="add-new-data" id="addCategory">
        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
                <h4 class="text-uppercase">{{ __('lang.users') }}</h4>
            </div>
            <div class="hide-data-sidebar">
                <i class="feather icon-x"></i>
            </div>
        </div>
        <div class="data-items pb-3">
            <div class="data-fields px-2 mt-3">
                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-name">{{ __('lang.name') }}</label>
                        <input type="text" class="form-control solid_required" id="add-name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-name">{{ __('lang.password') }}</label>
                        <input type="text" class="form-control solid_required" id="add-password" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-name">{{ __('lang.gender') }}</label>
                        <select class="form-control solid_required" id="add-gender">
                            <option value="male">{{ __('lang.male') }}</option>
                            <option value="female">{{ __('lang.female') }}</option>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-notification-limit">{{ __('lang.phone') }}</label>
                        <input type="number" class="form-control solid_required" id="add-phone" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-price" >{{ __('lang.city') }}</label>

                        <select class="form-control solid_required" id="city_id" onchange="getTwons(this.value,'add_town')">
                        <option value="">select</option>
                            
                            @foreach ($cities as $item)
                                <option value="{{ $item->city_id }}">{{ $item->name }}</option>
                            @endforeach`
                        </select>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-12 data-field-col" id='add_town'>
                            
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 data-field-col">
                            <label for="add-name">{{ __('lang.location_lat') }}</label>
                            <input type="text" class="form-control solid_required" id="add-location_lat" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 data-field-col">
                            <label for="add-name">{{ __('lang.location_lng') }}</label>
                            <input type="text" class="form-control solid_required" id="add-location_lng" />
                        </div>
                    </div>
                           
                    <input type="hidden" id="imageVal" name="imageUrl" />
                    <div class="col-sm-12 data-field-col data-list-upload">
                        <form action="uploads" class="dropzone" id="mydropzone" method="POST">
                            @csrf
                        </form>
                        <div id="preview-template" style="display: none">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image"><img data-dz-thumbnail="" /></div>
                                <div class="dz-details">
                                    <div class="dz-size"><span data-dz-size=""></span></div>
                                    <div class="dz-filename"><span data-dz-name=""></span></div>
                                </div>
                            </div>
                            <div class="dz-progress">
                                <span class="dz-upload" data-dz-uploadprogress=""></span>
                            </div>
                        </div>
                    </div>


                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary" onclick="addFormUpdate()">
                            {{ __('lang.data') }}
                        </button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">
                            {{ __('lang.cancle') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new sidebar ends -->
    </div>
    <!-- add details or options sidebar ends -->
</div>
<div class="add-new-data-sidebar">
    <div id="daddoverlay-bg" class="overlay-bg"></div>
    <div id="dddadd-new-data" class="add-new-data">
        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
                <h4 class="text-uppercase">
                    {{ __('lang.add_options_or_details') }}
                </h4>
            </div>
            <div class="hide-data-sidebar">
                <i class="feather icon-x"></i>
            </div>
        </div>
        <input type="hidden" id="product__id" name="product__id" value="" />

        <div class="container">
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">{{ __('lang.product_details') }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 data-field-col">
                    <label for="add-new-details-name">{{ __('lang.name') }}</label>
                    <input type="text" class="form-control" id="add-new-details-name" />
                </div>
            </div>

            

            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase">{{ __('lang.product_options') }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 data-field-col">
                    <label for="add-new-card-number">{{ __('lang.card_number') }}</label>
                    <input type="text" class="form-control" id="add-new-card-number" />
                </div>
            </div>
        </div>

        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
            <div class="add-data-btn">
                <button class="btn btn-info" onclick="addNewOptionsFourmUpdate()">
                    {{ __('lang.add') }}
                </button>
            </div>
            <div class="cancel-data-btn">
                <button class="btn btn-outline-danger ml-3">
                    {{ __('lang.cancle') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- edit sidebar starts -->
<div class="add-new-data-sidebar">
    <div id="editoverlay-bg-new" class="overlay-bg"></div>
    <div id="edit-new-data-new" class="add-new-data">
        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
                <h4 class="text-uppercase">{{ __('lang.editUser') }}</h4>
            </div>
            <div class="hide-data-sidebar">
                <i class="feather icon-x"></i>
            </div>
        </div>
        <div class="data-items pb-3">
            <div class="data-fields px-2 mt-3">
                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="add-name">Role</label>
                        <select class="form-control solid_up_required" id="edit-role_id">
                            <option value="0">NO Role</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{$role}}">{{$key}}</option>  
                            @endforeach

                        </select>
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <label for="edit-name">{{ __('lang.name') }}</label>
                        <input type="text" class="form-control solid_up_required" id="edit-name" />
                    </div>
                    
                    <div class="col-sm-12 data-field-col">
                        <label for="add-name">{{ __('lang.gender') }}</label>
                        <select class="form-control solid_up_required" id="edit-burber_gender">
                            <option value="male">{{ __('lang.male') }}</option>
                            <option value="female">{{ __('lang.female') }}</option>

                        </select>
                    </div>
                    

                    <div class="col-sm-12 data-field-col">
                        <label for="edit-price">{{ __('lang.phone') }}</label>
                        <input type="number" class="form-control solid_up_required" id="edit-phone" />
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <label for="edit-price" >{{ __('lang.city') }}</label>
                        
                        <select class="form-control solid_up_required" id="edit-city_id"  onchange="getTwons(this.value,'edit_town')">
                            @foreach ($cities as $item)
                                 <option value="{{ $item->city_id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 data-field-col">
                        <label for="edit-price" id="edit_town">{{ __('lang.town') }}</label>
                        
                        <input type="text" class="form-control solid_up_required" id="edit-town" />
                        
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <label for="edit-price">{{ __('lang.location_lat') }}</label>
                        <input type="text" class="form-control solid_up_required" id="edit-location_lat" />
                    </div>
                    <div class="col-sm-12 data-field-col">
                        <label for="edit-price">{{ __('lang.location_lng') }}</label>
                        <input type="text" class="form-control solid_up_required" id="edit-location_lng" />
                    </div>
                    <input type="hidden" id="edit-user_id" name="product_id" />

                    <input type="hidden" id="edit-imageVal" name="imageVal" />
                    <div class="col-sm-12 data-field-col data-list-upload">
                        <form action="uploads" class="dropzone dropzone-area" enctype="multipart/form-data"
                            id="dataListUpload2" method="POST">
                            @csrf
                            <div class="dz-message"></div>

                            <div id="imagesWrapper"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
            <div class="add-data-btn">
                <button class="btn btn-info" onclick="updateFormUpdate()">
                    {{ __('lang.update') }}
                </button>
            </div>
            <div class="cancel-data-btn">
                <button class="btn btn-outline-danger ml-3">
                    {{ __('lang.cancle') }}
                </button>
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
                            <input type="hidden"  id="product_id" >
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>


    function addNewOptionsFourmUpdate() {

        let ok = false ;
        // $( ".solid_required" ).each(function() {
        //     if($(this).val() == "" || $(this).val() == null)
        //     {

        //         $(this).addClass('validate');
        //         $(this).next('.msg').remove();
        //         $(this).after(`<label class="msg" >{{ __("lang.requiredfield")}}</label>`);
        //         ok = true ;
        //     }else {
        //         $(this).next('.msg').remove();
        //         $(this).removeClass('validate');
        //     }
        // });

        // if(ok)
        // {
        //     return ;
        // }

        $(".btn-primary").attr("disabled", true);

        let fd = {
                _token: '{{ csrf_token() }}',
                product_id: $('#product__id').val(),
                details_name: $('#add-new-details-name').val(),
                details_type: $('#add-new-details-type').val(),
                card_number: $('#add-new-card-number').val()
            }

        $.ajax({
            url: "add-product-data",
            method: 'POST',
            data: fd,
            success: function(res) {
                $(".btn-primary").removeAttr("disabled");
                $(".add-new-data").removeClass("show");
                $(".overlay-bg").removeClass("show");
                $("#data-name, #data-price").val("");
                $("#data-category, #data-status").prop("selectedIndex", 0);
                $("#products-table").DataTable().ajax.reload();
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
            },
            error: function(res) {
                // console.log(res);
                $(".btn-primary").removeAttr("disabled");
                alert("{{ __('lang.fillall')}}");
            }
        })
    }


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
                name: $('#add-name').val(),
                password:$('#add-password').val(),
                phone:$('#add-phone').val(),
                city: $('#city_id').val(),
                town_id: $('#town_id').val(),
                image: $('#imageVal').val(),
                gender:$('#add-gender').val(),
                location_lat:$('#add-location_lat').val(),
                location_lng:$('#add-location_lng').val(),
            }
        // console.log(fd)
        // return ;
        $.ajax({
            url: "add-users",
            method: 'POST',
            data: fd,
            success: function(res) {
                $(".btn-primary").removeAttr("disabled");
                $(".add-new-data").removeClass("show");
                $(".overlay-bg").removeClass("show");
                $("#data-name, #data-price").val("");
                $("#data-category, #data-status").prop("selectedIndex", 0);
                // $("#products-table").DataTable().ajax.reload();
                if(res.code == 200){
                    $("#products-table").DataTable().ajax.reload();
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $("#daddoverlay-bg").removeClass("show");
                    $("#dddadd-new-data").removeClass("show");
                    $('#add-name').val('');
                    $('#add-phone').val('');
                    $('#imageVal').val("");
                    $('#add-password').val("");
                    $('#add-city').val(0);
                }else{
                    $(".btn-primary").removeAttr("disabled");
                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"{{ __('lang.error') }}",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $("#daddoverlay-bg").removeClass("show");
                    $("#dddadd-new-data").removeClass("show");
                }
            },
            error: function(res) {
                // console.log(res);
                $(".btn-primary").removeAttr("disabled");
                alert(res.responseText);
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
        let town_id_new;
        if($('#town_id').val()!=null){
            town_id_new=$('#town_id').val();
        }
        else{
            town_id_new= $('#edit-town').val();
        }
        let fd = {
            _token: '{{ csrf_token() }}',
            user_id: $("#edit-user_id").val(),
            name: $("#edit-name").val(),
            phone: $("#edit-phone").val(),
            city: $('#edit-city_id').val(),
            town: town_id_new,
            about_us: $('#edit-about_us').val(),
            silver_price: $('#edit-silverPrice').val(),
            num_seats: $("#edit-num_seats").val(),
            type_queue: $('#edit-type_queue').val(),
            burber_gender: $("#edit-burber_gender").val(),
            location_lat: $("#edit-location_lat").val(),
            location_lng: $("#edit-location_lng").val(),
            image: $("#imageVal").val(),
            role:$("#edit-role_id").val(),
            // gurad
        }

        $.ajax({
            url: "edit-users",
            method: 'POST',
            data: fd,

            success: function(res) {
                $("#products-table").DataTable().ajax.reload();

                 if(res.code == 200){

                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                         buttonsStyling:!1,
                        // confirmButtonColor: "#DD6B55",

                    });
                     $("#editoverlay-bg-new").removeClass("show");
                     $("#edit-new-data-new").removeClass("show");
                }else{


                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"{{ __('lang.error') }}",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1

                    });
                }
            }
        })

    }
    function deleteFormUpdate() {
        let fd = {
            _token: '{{ csrf_token() }}',
            user_id: $('#product_id').val(),
        }

        $.ajax({
            url: "/delete-users",
            method: 'post',
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
                $("#products-table").DataTable().ajax.reload();
            }
        })
    }

    function inittable(role){
    $("#products-table").DataTable().destroy();
      var table= $("#products-table")
            .DataTable({
                responsive: !1,
                columnDefs: [
                    {
                        orderable: !0,
                        targets: !0,
                        checkboxes: {
                            selectRow: !0
                        }
                    }
                ],
                "serverSide": true,
                dom:
                    '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
                oLanguage: {
                    sLengthMenu: "_MENU_",
                    sSearch: ""
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/" +@switch (__('lang.directiontext'))@case ('rtl')"Arabic.json"@break @case ('ltr')"English.json" @break @default @endswitch
                },
                aLengthMenu: [
                    [1,5,10, 15, 20, 100, 500, 1000],
                    [1,5,10, 15, 20, 100, 500, 1000]
                ],
                select: {
                    style: "multi"
                },
                order: [[1, "asc"]],
                bInfo: !1,
                pageLength: 10,
                buttons: [
                    {
                        action: function() {
                            $("#addCategory").addClass("show");
                            $("#overlay-bg").addClass("show");
                           
                        },
                        className: "btn-outline-primary"
                    },
                    {
                        "extend": "csv",
                        "text": "Excel",
                        "filename": " users",
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
                initComplete: function(t, e) {
                    $(".dt-buttons .btn").removeClass("btn-secondary");
                },
                "ajax": "get-users?role="+role,
                "columns": [
                @can("users.c.name")
                    { "data": "name" , "defaultContent": "" },
                @endcan
                @can("users.c.image")
                    {"data": function(data){
                        return `
                        <img class="round" style="width:80px" src="${data.image}" alt="">
                        `;
                    }},
                @endcan
                @can("users.c.phone")
                    { "data": "phone" , "defaultContent": "" },
                @endcan
                @can("users.c.city")
                    { "data": "city_name" , "defaultContent": "" },
                @endcan
                @can("users.c.town")
                    { "data": "town_name" , "defaultContent": "" },
                @endcan
                @can("users.c.action")
                    {"data": function(data){
                        // console.log(data)
                        return `
                            <span class="action-edit" onclick="editNews(${data.id}, '${data.phone}',
                            '${data.name}' , '${data.image}', '${data.city}' ,'${data.town_name}',
                            '${data.gender}','${data.location_lat}','${data.location_lng}')">
                            <i class="feather icon-edit" title="{{__('lang.edit')}}"></i>
                            </span>
                            <span class="action-delete" onclick="deleteNews(${data.id})">
                            <i class="feather icon-trash" title="{{__('lang.delete')}}"></i>
                            </span>
                        
                        
                            
                        `;
                    }},
                @endcan
            ],

            })

            .on("draw.dt", function() {
                setTimeout(function() {
                    -1 != navigator.userAgent.indexOf("Mac OS X") &&
                        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass(
                            "mac-checkbox"
                        );
                }, 50);
            }
            );
    }

    $(document).ready(function() {
        inittable("user");
        $(".actions-dropodown").insertBefore($(".top .actions .dt-buttons")),
        0 < $(".data-items").length &&
            new PerfectScrollbar(".data-items", {
                wheelPropagation: !1
            }),
        $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on(
            "click",
            function() {
                $(".add-new-data").removeClass("show"),
                $(".overlay-bg").removeClass("show");
            }
        ),
        Dropzone.options.dataListUpload2 = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
            }
            else { done(); }
        }
        },
        (Dropzone.options.dataListUpload = {
            maxFiles: 1,

            complete: function(t) {

                $(
                    ".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons"
                ).on("click", function() {
                    $(".dropzone")[0].dropzone.files.forEach(function(t) {
                        t.previewElement.remove();
                    }),
                    $(".dropzone").removeClass("dz-started");

                });
            }
        }),
        Dropzone.options.dataListUpload.complete(),
        -1 != navigator.userAgent.indexOf("Mac OS X") &&
            $(".dt-checkboxes-cell input, .dt-checkboxes").addClass(
                "mac-checkbox"
            );

            $('#products-table tbody').on('click', '.selectme', function (e) {
                if(! $(this).prop('checked')){
                    $(this).closest('tr').removeClass('selected');
                }else{
                    $(this).closest('tr').addClass('selected');
                }
        });


    });

    function addData(id){

        $("#daddoverlay-bg").addClass("show");
        $("#dddadd-new-data").addClass("show");
        $("#product__id").val(unescape(id));

    }
    // editNews(${data.id}, '${data.phone}','${data.name}' , '${data.image}', '${data.city}' ,'${data.town}' ,'${data.about_us}''${data.num_seats}', '${data.description}', '${data.type_queue}')">
    

    function editNews(id, phone, name, imageUrl, city,town ,burber_gender,lat,lng){
        // alert(burber_gender);
        var imageIDs=imageUrl.split(',');
        var images=imageUrl.split(',');
        $('#imageVal').val(imageIDs);
        $('#imagesWrapper').empty();
        $("#dataListUpload2 .dz-preview").remove();

        if(images[0] != ''){
            images.forEach((element,index) => {
                // console.log(index);
                $('#imagesWrapper').append(`
                    <div class="dz-preview dz-processing dz-image-preview dz-success">
                        <div class="dz-details">
                            <div class="dz-filename"><span data-dz-name="">name</span></div>
                            <div class="dz-size" data-dz-size=""><strong></strong> </div> <img data-dz-thumbnail="" alt="name"
                                src="${element}">
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
                        <div class="dzx-success-mark" id="deleteMark" onclick="removePetShopImage(${id},clsrImageID('${imageIDs[index]}'))"><span><strong>✘</strong></span></div>
                    </div>
                `);

            });
        }
        // function editNews(town,about_us,num_seats ,type_queue,burber_gender){

        // $("#edit-category").val(unescape(category_id));
        $("#edit-user_id").val(unescape(id));
        $("#edit-name").val(unescape(name));
        $("#edit-phone").val(unescape(phone));
        $("#edit-city_id").val((city));
        $("#edit-town").val((town));
        $("#edit-location_lat").val((lat));
        $("#edit-location_lng").val((lng));
        $("#edit-burber_gender").val(unescape(burber_gender));
        

        $("#editoverlay-bg-new").addClass("show");
        $("#edit-new-data-new").addClass("show");

        $.ajax({
            url: "/get-user-role?user_id="+unescape(id),
            method: 'get',
            success: function(res) {
                $("#edit-role_id").val(res);
            }
        })    
    }

    function deleteNews(id){
        $("#deleteModal").modal('show');
        $("#product_id").val(id);
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
        // let dvetImage_id= $('#dvetImage_id').val()  ;
        let fd = {
            _token: '{{ csrf_token() }}',
            user_id: category_id,
            // dvetImage_id: dvetImage_id
        }
        $.ajax({
            url: "delete-users-image",
            method: 'post',
            data: fd,
            success: function(res) {
                $('#deleteVetShopImage').modal('hide');
                $("#products-table").DataTable().ajax.reload();
                if(res.code=200){
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $('#imageVal').val('');
                    $("#ddadd-new-data").removeClass('show');
                    $("#editoverlay-bg-new").removeClass("show");
                     $("#edit-new-data-new").removeClass("show");
                    $("#products-table").DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                }
                $("#products-table").DataTable().ajax.reload();

            }
        })
    }
    

    function getTwons(val,selector){
        // alert(val)
        $.ajax({
            type: "get",
            url: "getCityTowns",
            data:'city_id='+val,
            success: function(res){
                if(res.code==200){
                   let x=`<label for="add-price">{{ __('lang.town') }}</label>
                   <select id='town_id' class="form-control">`;
                    res.data.forEach(elem=>{
                        x+=`<option value="${elem.town_id}">${elem.name}</option>`;
                        // console.log(elem);
                    })
                    x+=`</select>`;
                    $(`#${selector}`).html(x);
                    $('#edit-town').remove();
                    
                }
            }
	});
    }


</script>
@endsection
