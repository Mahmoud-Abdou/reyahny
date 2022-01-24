@extends('dashboard_index')
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
            <table id="user-table" class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>{{ __('lang.image') }}</th>
                        <th>{{ __('lang.title') }}</th>
                        <th>{{ __('lang.body') }}</th>
                        <th>#</th>
                    </tr>
                </thead>

            </table>
        </div>
        <!-- dataTable ends -->

        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div class="overlay-bg" id="overlay-bg"></div>
            <div class="add-new-data" id="addproduct">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">{{ __('lang.product') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-title">{{ __('lang.title') }}</label>
                                <input type="text"  class="form-control solid_required" id="add-title">
                            </div>

                            <div class="col-sm-12 data-field-col">
                                <label for="data-body">{{ __('lang.body') }}</label>
                                <input type="text" class="form-control solid_required" id="add-body">
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
                </div>
               
   
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button class="btn btn-primary"  onclick="addFormUpdate()" >{{ __('lang.data') }}</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button class="btn btn-outline-danger">{{ __('lang.cancle') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add new sidebar ends -->
        <!-- add new sidebar starts -->
        <div class="add-new-data-sidebar">
            <div id="addoverlay-bg" class="overlay-bg"></div>
            <div id="ddadd-new-data" class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">{{ __('lang.editpro') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2 mt-3">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <label for="data-title">{{ __('lang.title') }}</label>
                                <input type="text" class="form-control solid_up_required" id="edit-title">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="edit-body">{{ __('lang.body') }}</label>
                                <input type="text" class="form-control solid_up_required" id="edit-body">
                            </div>

                            <input type="hidden" id="edit-imageVal" name="imageVal">
                            <input type="hidden" id="edit_news_id" name="news_id">
                            <div class="col-sm-12 data-field-col data-list-upload">
                                <form action="upload" class="dropzone dropzone-area" enctype="multipart/form-data" id="dataListUpload2" method="POST">
                                   @csrf
                                    <div class="dz-message">                                         
                                    </div>

                                    <div id="imagesWrapper"></div>
                                </form>
                            </div>

                           
                           
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
                            {{ csrf_field() }}
                            <input type="hidden"  id="del_news_id" > 
                            <div class="form-group ">
                                {{ __('lang.areyousuretodelete') }}  : <p id="news_title"></p> 
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
        if($("#imageVal").val()  == null || $("#imageVal").val()  ==""){
            alert('fsdf q');
            alert('{{__("lang.waitimage")}}');
            return ;
        }
        $(".btn-primary").attr("disabled", true);
       
         var tags = [];
            $.each($("input[name='addtags']:checked"), function(){
                tags.push($(this).val());
            });
            
        let fd = {
                _token: '{{ csrf_token() }}',
                title: $('#add-title').val(),
                body: $('#add-body').val(),
                imageUrl:    $('#imageVal').val(),
            }
        $.ajax({
            url: "add-news",
            method: 'POST',
            data: fd,
            success: function(res) {
                $(".btn-primary").removeAttr("disabled");
                $(".add-new-data").removeClass("show");
                $(".overlay-bg").removeClass("show");
                $("#data-name, #data-price").val("");
                $("#data-category, #data-status").prop("selectedIndex", 0);
                $("#user-table").DataTable().ajax.reload(); 
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

        var tags = [];
        $.each($("input[name='edittags']:checked"), function(){
            tags.push($(this).val());
        });
        let fd = {
            _token: '{{ csrf_token() }}',
            news_id: $("#edit_news_id").val(),
            title: $("#edit-title").val(),
            body: $("#edit-body").val(),
            imageUrl: $("#edit-imageVal").val(),
            
        }
          
        $.ajax({
            url: "edit-news",
            method: 'POST',
            data: fd,

            success: function(res) {
                $("#user-table").DataTable().ajax.reload(); 
                 if(res.code == "200"){
                    // alert("done");   
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
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
            }
        })
    }
    function deleteFormUpdate() {
        let fd = {
            _token: '{{ csrf_token() }}',
            news_id: $('#del_news_id').val(),
        }
         
        $.ajax({
            url: "delete-news",
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
                $("#user-table").DataTable().ajax.reload();    
            }
        })
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
    
     $(document).ready(function() {
       var table= $("#user-table")
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
                // "serverSide": true,
                dom:
                    '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
                oLanguage: {
                    sLengthMenu: "_MENU_",
                    sSearch: ""
                },
                // "language": {
                //     "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/" +@switch (__('lang.directiontext'))@case ('rtl')"Arabic.json"@break @case ('ltr')"English.json" @break @default @endswitch
                // },
                aLengthMenu: [
                    [10, 15, 20, 100, 500, 1000],
                    [10, 15, 20, 100, 500, 1000]
                ],
                select: {
                    style: "multi"
                },
                order: [[1, "asc"]],
                bInfo: !1,
                pageLength: 10,
                buttons: [
                    {
                        text: "<i class='feather icon-plus'></i> Add New",
                        action: function() {
                            $(this).removeClass("btn-secondary"),
                            $("#addproduct").addClass("show"),
                            $("#overlay-bg").addClass("show"),
                            $("#editProduct").css("display", "none");
                            $("#data-name").val(""),
                            $("#addProduct").css("display", "inline-flex");
                            $("#updateBtn").css("display", "none");
                            $("#addBtn").css("display", "inline-flex");
                        },
                        className: "btn-outline-primary"
                    }
                ],
                initComplete: function(t, e) {
                    $(".dt-buttons .btn").removeClass("btn-secondary");
                },
                "ajax": "get-news",
               "columns": [
                {"data": function(data){
                        return `                  
                        <div class="news-img">
                                <img style="width:50px;height:50px;" src="${data.image}"
                                    alt="Img placeholder">
                                </div>
                        `;
                    }
                },
                { "data": "title" , "defaultContent": "" },
                { "data": "body" , "defaultContent": "" },
                {"data": function(data){
                   return `
                        <span class="action-edit" onclick="editNews(${data.news_id},'${data.imageUrl}','${data.body}','${data.title}')">
                        <i class="feather icon-edit"></i>
                        </span>
                        <span class="action-delete" onclick="deleteNews(${data.news_id},'${data.title}')">
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
         
            $('#user-table tbody').on('click', '.selectme', function (e) {
                if(! $(this).prop('checked')){
                    $(this).closest('tr').removeClass('selected');
                }else{
                    $(this).closest('tr').addClass('selected');
                }
        });

        
    });

    function editNews(id, imageUrl, body, title){
        var imageIDs=imageUrl.split(',');
        var images=imageUrl.split(',');
        $('#edit-imageVal').val(imageUrl);
        $('#imagesWrapper').empty();
        $("#dataListUpload2 .dz-preview").remove();

        if(images[0]!=''){
            images.forEach((element,index) => {        
                // console.log(imageIDs[index]);
                // console.log(element);
                $('#imagesWrapper').append(`
                <div class="dz-preview dz-processing dz-image-preview dz-success">
                    <div class="dz-details">
                        <div class="dz-filename"><span data-dz-name="">name</span></div>
                        <div class="dz-size" data-dz-size=""><strong></strong> </div> <img data-dz-thumbnail="" alt="name"
                            src="${element}">
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
                    <div class="dzx-success-mark" onclick="removePetShopImage(${id},clsrImageID(${imageIDs[index]}))"><span >✘</span></div>
                </div>
                `);
                    
                });
            }  
        $("#edit_news_id").val(unescape(id));
        $("#edit-title").val(unescape(title));
        $("#edit-body").val(unescape(body));
        $("#addoverlay-bg").addClass("show");
        $("#ddadd-new-data").addClass("show");
        
     
    } 

    function deleteNews(id, name){
        $("#deleteModal").modal('show');
        $("#del_news_id").val(id);
    }


</script>
@endsection
