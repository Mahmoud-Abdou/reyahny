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
                            <a class="dropdown-item" onclick="openoffermodal()"><i
                                    class="feather icon-package"></i>{{ __('lang.addtooffer') }}</a>
                            <input type="hidden" name="ids" id="prod_id">
                        </div>
                    </div>
                </div>
            </div>
            <!-- dataTable starts -->
            <div class="table-responsive">
                <table id="category-table" class="table data-thumb-view">
                    <thead>
                        <tr>
                            <th>{{ __('lang.id') }}</th>
                            <th>{{ __('lang.name') }}</th>
                            <th>#</th>
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
                            <h4 class="text-uppercase">{{ __('lang.category') }}</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>
                    <div class="data-items pb-3">
                        <div class="data-fields px-2 mt-3">
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="add-name">{{ __('lang.name_ar') }}</label>
                                    <input type="text" class="form-control solid_required" id="add-name_ar">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="add-name">{{ __('lang.name_en') }}</label>
                                    <input type="text" class="form-control solid_required" id="add-name_en">
                                </div>

                            </div>


                            <input type="hidden" id="imageVal" name="imageUrl">
                            <div class="col-sm-12 data-field-col data-list-upload">
                                <form action="uploads" class="dropzone" id="mydropzone" method="POST">
                                    @csrf
                                </form>
                                <div id="preview-template" style="display: none;">
                                    <div class="dz-preview dz-file-preview">
                                        <div class="dz-image"><img data-dz-thumbnail=""></div>
                                        <div class="dz-details">
                                            <div class="dz-size"><span data-dz-size=""></span></div>
                                            <div class="dz-filename"><span data-dz-name=""></span></div>
                                        </div>


                                    </DIV>
                                    <DIV class="dz-progress"><SPAN class="dz-upload"
                                            data-dz-uploadprogress=""></SPAN></DIV>
                                </div>
                            </div>
                        </div>



                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button class="btn btn-primary" onclick="addFormUpdate()">{{ __('lang.data') }}</button>
                            </div>
                            <div class="cancel-data-btn">
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
                                <h4 class="text-uppercase">{{ __('lang.editCategory') }}</h4>
                            </div>
                            <div class="hide-data-sidebar">
                                <i class="feather icon-x"></i>
                            </div>
                        </div>
                        <div class="data-items pb-3">
                            <div class="data-fields px-2 mt-3">
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <label for="edit-name">{{ __('lang.name') }}</label>
                                        <input type="text" class="form-control solid_up_required" id="edit-name">
                                    </div>
                                    

                                    <input type="hidden" id="edit_category_id" name="category_id">

                                    

                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button class="btn btn-info"
                                    onclick="updateFormUpdate()">{{ __('lang.update') }}</button>
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
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title ">
                            <div id="model">{{ __('lang.delete') }}</div>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                        {{-- <form action="#" method="POST"> --}}
                            {{-- {{ csrf_field() }} --}}
                            <input type="
                            hidden" id="category_id">
                            <div class="form-group ">
                                {{ __('lang.areyousuretodelete') }} : <p id="group_title"></p>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class=" btn  btn-primary "
                                    onclick="deleteFormUpdate()">{{ __('lang.delete') }}</button>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- delete PetShop Image modal --}}
        <div class="modal" id="deleteVetShopImage">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title ">
                            <div id="model">{{ __('lang.delete') }}</div>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                        {{-- <form action="#" method="POST"> --}}
                            {{ csrf_field() }}
                            <input type="
                            hidden" id="vett_id">
                            <input type="hidden" id="dvetImage_id">

                            <div class="form-group ">
                                {{ __('lang.areyousuretodelete') }} : <p id="dpet_name"></p>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class=" btn  btn-primary "
                                    onclick="deleteVetShopImage()">{{ __('lang.delete') }}</button>
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
            let ok = false;
            $(".solid_required").each(function() {
                if ($(this).val() == "" || $(this).val() == null) {
                    $(this).addClass('validate');
                    $(this).next('.msg').remove();
                    $(this).after(`<label class="msg" >{{ __('lang.requiredfield') }}</label>`);
                    ok = true;
                } else {
                    $(this).next('.msg').remove();
                    $(this).removeClass('validate');
                }
            });

            if (ok) {
                return;
            }

            $(".btn-primary").attr("disabled", true);

            let fd = {
                _token: '{{ csrf_token() }}',
                name_ar: $('#add-name_ar').val(),
                name_en: $('#add-name_en').val(),
            }
            $.ajax({
                url: "add-category",
                method: 'POST',
                data: fd,
                success: function(res) {
                    $(".btn-primary").removeAttr("disabled");
                    $(".add-new-data").removeClass("show");
                    $(".overlay-bg").removeClass("show");
                    $("#data-name, #data-price").val("");
                    $("#data-category, #data-status").prop("selectedIndex", 0);
                    $("#category-table").DataTable().ajax.reload();
                    if (res.code == "200") {
                        $("#category-table").DataTable().ajax.reload();
                        Swal.fire({
                            title: "{{ __('lang.success') }}",
                            text: "{{ __('lang.success') }}",
                            type: "success",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                        $('#add-description').val("");
                        $('#parent').val(0);
                        $('#imageVal').val("");
                        $('#is_market').val(0);
                        $('#add-name').val("");
                        $('#group-id').val("");
                    } else {
                        $(".btn-primary").removeAttr("disabled");
                        Swal.fire({
                            title: "{{ __('lang.error') }}",
                            text: "{{ __('lang.error') }}",
                            type: "error",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                    }
                    // location.reload();
                },
                error: function(res) {
                    // console.log(res);
                    $(".btn-primary").removeAttr("disabled");
                    alert("{{ __('lang.fillall') }}");
                }
            })
        }

        function updateFormUpdate() {
            // alert($("#product-id").val());
            let ok = false;
            $(".solid_up_required").each(function() {
                if ($(this).val() == "" || $(this).val() == null) {
                    $(this).addClass('validate');
                    $(this).next('.msg').remove();
                    $(this).after(`<label class="msg" >{{ __('lang.requiredfield') }}</label>`);
                    ok = true;
                } else {
                    $(this).next('.msg').remove();
                    $(this).removeClass('validate');
                }
            });
            if (ok) {
                return;
            }

            let fd = {
                _token: '{{ csrf_token() }}',
                category_id: $("#edit_category_id").val(),
                name: $("#edit-name").val(),
            }

            $.ajax({
                url: "edit-category",
                method: 'POST',
                data: fd,

                success: function(res) {
                    $("#group-table").DataTable().ajax.reload();
                    if (res.code == "200") {
                        // alert("done");
                        Swal.fire({
                            title: "{{ __('lang.success') }}",
                            text: "{{ __('lang.success') }}",
                            type: "success",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                        $("#addoverlay-bg").removeClass("show");
                        $("#ddadd-new-data").removeClass("show");
                    } else {
                        // alert("error");

                        Swal.fire({
                            title: "{{ __('lang.error') }}",
                            text: "{{ __('lang.error') }}",
                            type: "error",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                    }
                }
            })
            $("#category-table").DataTable().ajax.reload();
            // location.reload();
        }

        function deleteFormUpdate() {
            let fd = {
                _token: '{{ csrf_token() }}',
                category_id: $('#category_id').val(),
            }

            $.ajax({
                url: "delete-category",
                method: 'post',
                data: fd,
                success: function(res) {
                    $('#deleteModal').modal('hide');
                    if (res.code == 200) {
                        Swal.fire({
                            title: "{{ __('lang.success') }}",
                            text: "",
                            type: "success",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                    } else {
                        Swal.fire({
                            title: "{{ __('lang.error') }}",
                            text: "",
                            type: "error",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                    }
                    $("#category-table").DataTable().ajax.reload();
                    location.reload();
                }
            })
        }



        $(document).ready(function() {
            var table = $("#category-table")
                .DataTable({
                    responsive: !1,
                    columnDefs: [{
                        orderable: !0,
                        targets: [3],
                        checkboxes: {
                            selectRow: !0
                        }
                    }],
                    "serverSide": true,
                    dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
                    oLanguage: {
                        sLengthMenu: "_MENU_",
                        sSearch: ""
                    },
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/" + @switch(__(
                            'lang.directiontext')) @case ('rtl')"Arabic.json"@break @case ('ltr')"English.json" @break @default @endswitch
                    },
                    aLengthMenu: [
                        [1, 5, 10, 15, 20, 100, 500, 1000],
                        [1, 5, 10, 15, 20, 100, 500, 1000]
                    ],
                    select: {
                        style: "multi"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    bInfo: !1,
                    pageLength: 10,
                    buttons: [{
                        text: "<img src='app-assets/images/mobicard/Group 104.png' class='img-fluid'> {{ __('lang.add_Category') }}",
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
                    }],
                    initComplete: function(t, e) {
                        $(".dt-buttons .btn").removeClass("btn-secondary");
                    },
                    "ajax": "get-categories",
                    "columns": [{
                            "data": "_id",
                            "defaultContent": ""
                        },
                        {
                            "data": "name",
                            "defaultContent": ""
                        },
                        {
                            "data": function(data) {

                                return `
                                    <span class="action-edit" onclick="editNews('${data._id}', '${data.name}')">
                                    <i class="feather icon-edit"></i>
                                    </span>
                                    <span class="action-delete" onclick="deleteNews('${data._id}')">
                                    <i class="feather icon-trash"></i>
                                    </span>
                                     `;
                            }
                        },
                    ],

                });


            // .on("draw.dt", function() {
            //     setTimeout(function() {
            //         -1 != navigator.userAgent.indexOf("Mac OS X") &&
            //             $(".dt-checkboxes-cell input, .dt-checkboxes").addClass(
            //                 "mac-checkbox"
            //             );
            //     }, 50);
            // }
            // );
            // table.on( 'xhr', function () {
            //     var json = table.ajax.json();
            //     json.data.forEach(data => {
            //         $("#add-mainCategory").append(new Option(`${data.name}`, `${data.category_id}`));
            //         $("#edit-parentCategory").append(new Option(`${data.name}`, `${data.category_id}`));

            //     });
            // });
            // $(".actions-dropodown").insertBefore($(".top .actions .dt-buttons")),
            // 0 < $(".data-items").length &&
            //     new PerfectScrollbar(".data-items", {
            //         wheelPropagation: !1
            //     }),
            // $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on(
            //     "click",
            //     function() {
            //         $(".add-new-data").removeClass("show"),
            //         $(".overlay-bg").removeClass("show");
            //     }
            // ),
            // Dropzone.options.dataListUpload2 = {
            // paramName: "file", // The name that will be used to transfer the file
            // maxFilesize: 2, // MB
            // accept: function(file, done) {
            //     if (file.name == "justinbieber.jpg") {
            //     done("Naha, you don't.");
            //     }
            //     else { done(); }
            // }
            // },
            // (Dropzone.options.dataListUpload = {
            //     maxFiles: 1,

            //     complete: function(t) {

            //         $(
            //             ".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons"
            //         ).on("click", function() {
            //             $(".dropzone")[0].dropzone.files.forEach(function(t) {
            //                 t.previewElement.remove();
            //             }),
            //             $(".dropzone").removeClass("dz-started");

            //         });
            //     }
            // }),
            // Dropzone.options.dataListUpload.complete(),
            // -1 != navigator.userAgent.indexOf("Mac OS X") &&
            //     $(".dt-checkboxes-cell input, .dt-checkboxes").addClass(
            //         "mac-checkbox"
            //     );

            //     $('#group-table tbody').on('click', '.selectme', function (e) {
            //         if(! $(this).prop('checked')){
            //             $(this).closest('tr').removeClass('selected');
            //         }else{
            //             $(this).closest('tr').addClass('selected');
            //         }
            // });


        });

        function editNews(id, name) {
            // var imageIDs = imageUrl.split(',');
            // var images = imageUrl.split(',');
            // $('#imageVal').val(imageIDs);
            // $('#edit-order').val(order);
            // $('#imagesWrapper').empty();
            // $("#dataListUpload2 .dz-preview").remove();

            // if (images[0] != '') {
            //     images.forEach((element, index) => {
            //         console.log(index);
            //         $('#imagesWrapper').append(`
            //         <div class="dz-preview dz-processing dz-image-preview dz-success">
            //             <div class="dz-details">
            //                 <div class="dz-filename"><span data-dz-name="">name</span></div>
            //                 <div class="dz-size" data-dz-size=""><strong></strong> </div> <img data-dz-thumbnail="" alt="name"
            //                     src="${element}">
            //             </div>
            //             <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
            //             <div class="dzx-success-mark" onclick="removePetShopImage(${id},clsrImageID('${imageIDs[index]}'))"><span >✘</span></div>
            //         </div>
            //     `);

            //     });
            // }

            $("#edit_category_id").val(unescape(id));
            $("#edit-name").val(unescape(name));
            $("#addoverlay-bg").addClass("show");
            $("#ddadd-new-data").addClass("show");
            $("#edit-parentCategory select").val(parent_category);
        }

        function deleteNews(id) {
            $("#deleteModal").modal('show');
            $("#category_id").val(id);
        }

        function clsrImageID(imgID) {
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
                        data: {
                            request: 2
                        },
                        dataType: 'json',
                        success: function(response) {

                            $.each(response, function(key, value) {
                                var mockFile = {
                                    name: value.name,
                                    size: value.size
                                };

                                myDropzone.emit("addedfile", mockFile);
                                myDropzone.emit("thumbnail", mockFile, value.path);
                                myDropzone.emit("complete", mockFile);

                            });

                        }
                    });
                }
            });
        });

        function removePetShopImage(vetID, vetImageID) {

            $('#vett_id').val(vetID);
            $('#dvetImage_id').val(vetImageID);
            $("#deleteVetShopImage").modal('show');

        }

        function deleteVetShopImage() {
            let category_id = $('#vett_id').val();
            let dvetImage_id = $('#dvetImage_id').val();
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
                    console.log('aaaaqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq')
                    $('#deleteVetShopImage').modal('hide');
                    $("#category-table").DataTable().ajax.reload();
                    location.reload();
                    if (res.code == 200) {
                        Swal.fire({
                            title: "{{ __('lang.success') }}",
                            text: "",
                            type: "success",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                        $("#category-table").DataTable().ajax.reload();
                        $("#ddadd-new-data").removeClass('show');
                    } else {
                        Swal.fire({
                            title: "{{ __('lang.error') }}",
                            text: "",
                            type: "error",
                            confirmButtonClass: "btn btn-primary",
                            buttonsStyling: !1
                        });
                    }
                    $("#category-table").DataTable().ajax.reload();

                }
            })
        }
    </script>
@endsection
