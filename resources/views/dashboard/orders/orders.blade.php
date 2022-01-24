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
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="order-tabele">
            <thead>
            <tr>
                <th scope="col">{{ __('lang.name')  }}</th>
                <th scope="col">{{ __('lang.userName')  }}</th>
                {{-- <th scope="col">{{ __('lang.balance')  }}</th> --}}
                <th scope="col">{{ __('lang.requstedOption')  }}</th>
                 <th scope="col">{{ __('lang.date')  }}</th>
                <th scope="col">{{ __('lang.status')  }}</th>
                <th scope="col">#</th>

            </tr>
            </thead>
            <tbody>
                {{-- @foreach ($orders as $order)
                <tr>
                    <td> {{ $order->product->name }}</td>
                    <td> {{ $order->user->name }}</td>
                    <td>
                    @foreach ($order->orderDetails as $item)
                        @if ($item->typeOfDetails_id == '1')
                            <small> GameID:</small> -
                        @elseif($item->typeOfDetails_id == '2')
                            <small> Name:</small> -
                        @elseif($item->typeOfDetails_id == '3')
                            <small> Addres:</small> -
                        @endif
                    @endforeach
                    </td>
                    <td>
                        @foreach ($order->orderDetails as $item)
                            <small>{{ $item->value }}</small> -
                        @endforeach
                    </td>
                    <td>
                    <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if($order->status == '0')
                                {{ __('lang.pending') }}
                                @elseif($order->status == '1')
                                {{ __('lang.compeleted') }}
                                @elseif($order->status == '2')
                                {{ __('lang.cancelled') }}
                                @endif
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('order.accept', $order->id ) }}">  {{ __('lang.compeleted') }} </a>
                            <a class="dropdown-item" href="{{ route('order.pending', $order->id ) }}">  {{ __('lang.pending') }}</a>
                            <a class="dropdown-item" href="{{ route('order.cancel', $order->id ) }}">  {{ __('lang.cancelled') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach --}}


            </tbody>
        </table>
    </div>
   <!-- edit sidebar starts -->
   <div class="add-new-data-sidebar">
    <div id="addoverlay-bg" class="overlay-bg"></div>
    <div id="ddadd-new-data" class="add-new-data">
        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
            <div>
                <h4 class="text-uppercase">{{ __('lang.status') }}</h4>
            </div>
            <div class="hide-data-sidebar">
                <i class="feather icon-x"></i>
            </div>
        </div>
        <div class="data-items pb-3">
            <div class="data-fields px-2 mt-3">
                <div class="row">
                    <div class="col-sm-12 data-field-col">
                        <label for="edit-name">{{ __('lang.status') }}</label>
                        <select name="cars" id="edit-status" class="form-control solid_up_required">
                            <option value="1">{{ __('lang.compeleted') }}</option>
                            <option value="0">{{ __('lang.pending') }}</option>
                            <option value="2">{{ __('lang.cancelled') }}</option>
                          </select>
                    </div>
                    <input type="hidden" class="form-control solid_up_required" id="edit_status_id">





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
    </section>
</section>
{{-- {{ $orders->links() }} --}}
<script>
       $(document).ready(function() {
        var table= $("#order-tabele")
            .DataTable({
                responsive: !1,
                columnDefs: [
                    {
                        orderable: !0,
                        targets: [3],
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
                    [1, 10, 15, 20, 100, 500, 1000],
                    [1, 10, 15, 20, 100, 500, 1000]
                ],
                select: {
                    style: "multi"
                },
                order: [[1, "asc"]],
                bInfo: !1,
                pageLength: 10,
                buttons: [
                    {
                        text: "",
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
                "ajax": "get-orders",
                "columns": [

                {"data": function(data){
                    if(data.product !== null){
                        return `
                          ${data.product.name}
                    `; }
                    return `DELETED Product`;
                }},
                {"data": function(data){
                    if(data.user !== null ){

                    return `
                            ${data.user.name}
                        `;
                    }
                    else{
                        return "DELETED user";
                    }
                }},

                {"data": function(data){
                    let x =``;
                    data.order_details.forEach(function(item) {
                        x+=`${item.value} - `
                    });
                    return x;
                }},
                    {"data":'updated_at'},
                {"data": function(data){
                    var status='{{ __('lang.pending') }}';
                    // {{ __('lang.compeleted') }}
                    // {{ __('lang.cancelled') }}
                    switch (data.status) {
                        case 1:
                            status='{{ __('lang.compeleted') }}';
                            break;
                        case 2:
                            status='{{ __('lang.cancelled') }}';
                            break;

                        default:
                            break;
                    }
                   return `
                        ${status}
                    `;
                }},
                {"data": function(data){
                   return `
                        <span class="action-edit" onclick="editNews(${data.id}, '${data.status}')">
                        <i class="feather icon-edit"></i>
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

            $('#group-table tbody').on('click', '.selectme', function (e) {
                if(! $(this).prop('checked')){
                    $(this).closest('tr').removeClass('selected');
                }else{
                    $(this).closest('tr').addClass('selected');
                }
        });


    });
    function getStatus(status)
    {
        console.log('status',status)
        if(status==1){
            return "completed";
        }
        else if(status==0)
        {
            return "pending";
        }
        else
        {
            return "cancelled";
        }


    }


    function editNews(id,status){

        $("#edit_status_id").val((id));
        $("#edit-status").val(status);
        $("#addoverlay-bg").addClass("show");
        $("#ddadd-new-data").addClass("show");
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
            order_id: $("#edit_status_id").val(),
            status: $("#edit-status").val(),
        }
          console.log('------->:',fd.status);
        $.ajax({
            url: "edit-status",
            method: 'POST',
            data: fd,

            success: function(res) {
                 if(res.code == "200"){
                console.log("DDAFSDF");
                    Swal.fire({
                        title:"{{ __('lang.success') }}",
                        text:"{{ __('lang.success') }}",
                        type:"success",
                        confirmButtonClass:"btn btn-primary",
                        buttonsStyling:!1
                    });
                    $("#addoverlay-bg").removeClass("show");
                    $("#ddadd-new-data").removeClass("show");
                    $("#order-tabele").DataTable().ajax.reload();
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
</script>
@endsection
