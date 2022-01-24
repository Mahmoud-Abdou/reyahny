@extends('dashboard.index')
@section('content')

<section>
    <section id="data-thumb-view" class="data-thumb-view-header">

        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">

                <div class="btn-group dropdown actions-dropodown">
                    {{-- <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('lang.actions') }}
                    </button> --}}
                    <div class="dropdown-menu dropdown-menu-right ">
                        <a class="dropdown-item" onclick="openoffermodal()"><i class="feather icon-package"></i>{{ __('lang.addtooffer') }}</a>
                        <input type="hidden" name="ids" id="prod_id">
                    </div>
                </div>
            </div>
        </div>
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table id="sliders-table" class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>{{ __('lang.key') }}</th>
                        <th>{{ __('lang.value') }}</th>
                        <th>#</th>
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
                        <h4 class="text-uppercase">{{ __('lang.settings')}}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3" style="overflow : hidden">
                    <div class="data-fields px-2 mt-3" >
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="add-name">{{ __('lang.key') }}</label>
                                <input type="text"  class="form-control solid_required" id="add-key">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="add-action-link">{{ __('lang.value') }}</label>
                                <input type="text"  class="form-control solid_required" id="add-value">
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
                        <h4 class="text-uppercase">{{ __('lang.editSlider') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="edit-name">{{ __('lang.value') }}</label>
                                <input type="text" class="form-control solid_up_required" id="edit-value">
                            </div>

                            <input type="hidden" id="edit_settings_id" name="settings_id">

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
                            <input type="hidden"  id="settings_id" >
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
                key: $('#add-key').val(),
                value:$('#add-value').val(),
               
            }
        $.ajax({
            url: "add-settings",
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
                    $('#add-key').val("");
                    $('#add-value').val("");
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
                console.log(res);
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
            settings_id: $("#edit_settings_id").val(),
            value: $("#edit-value").val(),
            // action_link: $("#edit-action-link").val(),
            // image: $("#imageVal").val(),

        }

        $.ajax({
            url: "edit-settings",
            method: 'POST',
            data: fd,

            success: function(res) {
                $("#group-table").DataTable().ajax.reload();
                 if(res.code == "200"){
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
                    // alert("error");

                    Swal.fire({
                        title:"{{ __('lang.error') }}",
                        text:"{{ __('lang.error') }}",
                        type:"error",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                }
                $("#sliders-table").DataTable().ajax.reload();
            },error: function(res) {
                console.log(res);
                $(".btn-primary").removeAttr("disabled");
                alert(res.responseText)
                //alert("{{ __('lang.fillall')}}");
            }
        })
    }
    function deleteFormUpdate() {
        let fd = {
            _token: '{{ csrf_token() }}',
            settings_id: $('#settings_id').val(),
        }

        $.ajax({
            url: "delete-settings",
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
                $("#sliders-table").DataTable().ajax.reload();
            }
        })
    }



    $(document).ready(function() {
        var table= $("#sliders-table")
            .DataTable({
                responsive: !1,
                columnDefs: [
                    {
                        orderable: !0,
                        targets: 0,
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
                    // "url":"http://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
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
                        text: "<img src='app-assets/images/mobicard/Group 104.png' class='img-fluid'> {{__('lang.add_setting')}}",
                        action: function() {
                            $(this).removeClass("btn-secondary"),
                            $("#addCategory").addClass("show"),
                            $("#overlay-bg").addClass("show"),
                            $("#editProduct").css("display", "none");
                            $("#data-name").val(""),
                            $("#addProduct").css("display", "inline-flex");
                            $("#updateBtn").css("display", "none");
                            $("#addBtn").css("display", "inline-flex");
                        },
                        className: "btn-outline-primary"
                    },
                    {
                        "extend": "csv",
                        "text": "Excel",
                        "filename": " settigns",
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
                "ajax": "get-settings",
                "columns": [
                { "data": "key" , "defaultContent": "" },
                { "data": "value" , "defaultContent": "" },

                {"data": function(data){
                    console.log(data._id)
                   return `
                        <span class="action-edit" onclick="editNews('${data._id}', '${escape(data.value)}')">
                        <i class="feather icon-edit"></i>
                        </span>
                        <span class="action-delete" onclick="deleteNews('${data._id}')">
                        <i class="feather icon-trash"></i>
                        </span>
                    `;
                }},
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
        maxFilesize: 1, // MB
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
                // console.log("Sdsdsdsdsdssdsdsdsdd");
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

            $('#group-table tbody').on('click', '.selectme', function (e) {
                if(! $(this).prop('checked')){
                    $(this).closest('tr').removeClass('selected');
                }else{
                    $(this).closest('tr').addClass('selected');
                }
        });


    });
   // editNews(${data.id}, '${data.name}','${data.image}' , '${data.action_link}')">
    function editNews(id, name, imageUrl, actionLink){
        // var imageIDs=imageUrl.split(',');
        // var images=imageUrl.split(',');
        // $('#imageVal').val(imageIDs);
        // $('#imagesWrapper').empty();
        // $("#dataListUpload2 .dz-preview").remove();

        // if(images[0] != ''){
        //     images.forEach((element,index) => {
        //         console.log(index);
        //         $('#imagesWrapper').append(`
        //             <div class="dz-preview dz-processing dz-image-preview dz-success">
        //                 <div class="dz-details">
        //                     <div class="dz-filename"><span data-dz-name="">name</span></div>
        //                     <div class="dz-size" data-dz-size=""><strong></strong> </div> <img data-dz-thumbnail="" alt="name"
        //                         src="${element}">
        //                 </div>
        //                 <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
        //                 <div style="width: max-content" class="dzx-success-mark" onclick="removePetShopImage(${id},clsrImageID('${imageIDs[index]}'))"><span >✘</span></div>
        //             </div>
        //         `);

        //     });
        // }
        $("#edit_settings_id").val(unescape(id));
        $("#edit-value").val(unescape(name));
        // $("#edit-action-link").val(unescape(actionLink));
        // // $("#edit-discount").val(unescape(discount));
        // $("#edit-description").val(unescape(description));
        $("#addoverlay-bg").addClass("show");
        $("#ddadd-new-data").addClass("show");
        // $("#edit-parentCategory select").val(parent_category);
    }

    function deleteNews(id){
        $("#deleteModal").modal('show');
        $("#settings_id").val(id);
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
            slider_id: category_id,
            // dvetImage_id: dvetImage_id
        }
        $.ajax({
            url: "delete-slider-image",
            method: 'post',
            data: fd,
            success: function(res) {
                $('#deleteVetShopImage').modal('hide');
                $("#sliders-table").DataTable().ajax.reload();
                if(res.code == 200){
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $("#sliders-table").DataTable().ajax.reload();
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
                $("#sliders-table").DataTable().ajax.reload();
            }
        })
    }


</script>
@endsection
