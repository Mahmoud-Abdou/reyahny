@extends('dashboard.index')
 @section('content')



 <section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">{{ __('lang.from') }}</span>
                </div>
                <input type="date" class="form-control solid_filter" aria-label="Username" 
                aria-describedby="basic-addon1" id="cards_from">
              </div>
           </div>
           <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">{{ __('lang.to') }}</span>
                </div>
                <input type="date" class="form-control solid_filter"  aria-label="Username"
                 aria-describedby="basic-addon1" id="cards_end">
              </div>
           </div>
           <div class="col-md-4">
            <div class="input-group mb-3">
               <button class="btn filter-btn" onclick="filterCards()">{{ __('lang.filter') }}</button>
              </div>
           </div> 
    </div>
   <div class="row">
     <div class="col-lg-3 col-sm-6 col-12 pb-2"> 
         <div class="card">
             <div class="card-header d-flex flex-column align-items-start pb-0">
                 <div class="avatar bg-rgba-primary p-50 m-0">
                     <div class="avatar-content">
                        <a href="/users">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="user_card">{{  $data['users']??0 }}</p>
                     </div>
                 </div>

                <p class="mb-1">{{ __('lang.users')}}</p>
             </div>

         </div>
     </div>

     <div class="col-lg-3 col-sm-6 col-12">
         <div class="card">
             <div class="card-header d-flex flex-column align-items-start pb-0">
                 <div class="avatar bg-rgba-danger p-50 m-0">
                     <div class="avatar-content">
                         <a href="/vendors">
                            <i class="feather icon-shopping-cart text-warning font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="vendor_card">{{  $data['vendors']??0 }}</p>
                     </div>
                 </div>

                <p class="mb-1">{{ __('lang.vendors')}}</p>
             </div>

         </div>
     </div>
     <div class="col-lg-3 col-sm-6 col-12">
         <div class="card">
             <div class="card-header d-flex flex-column align-items-start pb-0">
                 <div class="avatar bg-rgba-warning p-50 m-0">
                     <div class="avatar-content">
                         <a href="/services">
                            <i class="feather icon-credit-card text-danger font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="service_card">{{  $data['services']??0 }} </p>
                     </div>
                 </div>
                 <p class="mb-1">{{ __('lang.services') }}</p>
             </div>

         </div>
     </div>
     <div class="col-lg-3 col-sm-6 col-12">
         <div class="card">
             <div class="card-header d-flex flex-column align-items-start pb-0">
                 <div class="avatar bg-rgba-warning p-50 m-0">
                     <div class="avatar-content">
                        <a href="/services">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="sub_service_card">{{  $data['sub_services']??0 }}</p>
                     </div>
                 </div>
                 <p class="mb-1">{{ __('lang.sub_servies') }}</p>
             </div>

         </div>
     </div>
     <div class="col-lg-3 col-sm-6 col-12">
         <div class="card">
             <div class="card-header d-flex flex-column align-items-start pb-0">
                 <div class="avatar bg-rgba-warning p-50 m-0">
                     <div class="avatar-content">
                        <a href="/bookings">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="booking_card">{{  $data['bookings']??0 }}</p>
                     </div>
                 </div>
                 <p class="mb-1">{{ __('lang.bookings') }}</p>
             </div>

         </div>
     </div>
     <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                       <a href="/bookings">
                           <i class="feather icon-package text-warning font-medium-5"></i>
                       </a>
                        <p class="mb-0 avatar-num"id="cancelled_booking_user_card">
                           {{  $data['cancelled_bookings_user']??0 }}
                        </p>
                    </div>
                </div>
                <p class="mb-1">{{ __('lang.cancelled_bookings_user') }}</p>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                       <a href="/bookings">
                           <i class="feather icon-package text-warning font-medium-5"></i>
                       </a>
                       <p class="mb-0 avatar-num" id="cancelled_booking_vendor_card">{{  $data['cancelled_bookings_vendor']??0 }}</p>
                    </div>
                </div>
                <p class="mb-1">{{ __('lang.cancelled_bookings_vendor') }}</p>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                       <a href="/bookings">
                           <i class="feather icon-package text-warning font-medium-5"></i>
                       </a>
                       <p class="mb-0 avatar-num" id="completed_booking_vendor_card">
                           {{  $data['completed_bookings_vendor']??0 }}</p>
                    </div>
                </div>
                <p class="mb-1">{{ __('lang.completed_bookings_vendor') }}</p>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                        <a href="/bookings">
                           <i class="feather icon-package text-warning font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="notshown_booking_card">
                           {{  $data['notshown_bookings']??0 }}
                        </p>
                    </div>
                </div>
                <p class="mb-1">{{ __('lang.notshown_bookings') }}</p>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start pb-0">
                <div class="avatar bg-rgba-warning p-50 m-0">
                    <div class="avatar-content">
                        <a href="/bookings">
                            <i class="feather icon-package text-warning font-medium-5"></i>
                        </a>
                        <p class="mb-0 avatar-num" id="pending_booking_card">
                           {{  $data['pending_bookings']??0 }}
                        </p>
                    </div>
                </div>
                <p class="mb-1">{{ __('lang.pending_bookings') }}</p>
            </div>

        </div>
    </div>
 

   </div>
 

    <div class="row">
       <div class="col">
           <h2 style="font-weight : bold; margin-bottom : 30px">{{__('lang.payments')}}</h2>
       </div>
   </div>
   <div class="row">
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">{{ __('lang.from') }}</span>
            </div>
            <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="payments_from">
          </div>
       </div>
       <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">{{ __('lang.to') }}</span>
            </div>
            <input type="date" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="payments_end">
          </div>
       </div>
       <div class="col-md-4">
        <div class="input-group mb-3">
           <button class="btn filter-btn" onclick="paymentFilter()">{{ __('lang.filter') }}</button>
          </div>
       </div>
       <div class="col-lg-12 col-md-6 col-12">
           <div class="card">
               <div class="card-header d-flex justify-content-between align-items-end">
                   <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
               </div>
               <div class="card-content">
                   <div class="card-body pb-0">

                       <div id="revenue-chart"></div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="row">
       <div class="col">
           <h2 style="font-weight: bold; margin-bottom : 30px">{{__('lang.usersAcounts')}}</h2>
       </div>
   </div>
   <div class="row">
    <div class="col-md-4">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">{{ __('lang.from') }}</span>
            </div>
            <input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="users_from">
        </div>
    </div>
  
   <div class="col-md-4">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">{{ __('lang.to') }}</span>
        </div>
        <input type="date" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="users_end">
      </div>
   </div>
   <div class="col-md-4">
    <div class="input-group mb-3">
       <button class="btn filter-btn" onclick="userFilter()">{{ __('lang.filter') }}</button>
      </div>
   </div>
</div>
       <div class="col-lg-12 col-md-6 col-12">
           <div class="card">
               <div class="card-header d-flex justify-content-between align-items-end">
                   <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
               </div>
               <div class="card-content">
                   <div class="card-body pb-0">

                       <div id="revenue-chart-2"></div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   
   <div class="row">
       <div class="col">
           <h2 style="margin-bottom : 30px; font-weight : bold">{{__('lang.bookings')}}</h2>
       </div>
       
   </div>
   
       <div class="row">
           <div class="col-md-6" style="margin-bottom: 30px">
               <input type="date" name="" class="form-control" id="booking_from">
           </div>
           <div class="col-md-6" style="margin-bottom: 30px">
            <input type="date" name="" class="form-control" id="booking_to">
           </div>
           <div class="col-md-3">
            <select name="" id="booking_status" class="form-control">
                <option value="">{{ __('lang.select') }}</option>
                <option value="1">{{ __('lang.completed') }}</option>
                <option value="2">{{ __('lang.cancelled') }}</option>
                <option value="0">{{ __('lang.pending') }}</option>
                <option value="3">{{ __('lang.notshown') }}</option>
                
            </select>
           </div>
           <div class="col-md-3 ml-2">
            <select name="" id="booking_service" class="form-control">
                <option value="">{{ __('lang.select') }}</option>
                @foreach ($data['parent_services']??[] as $item)
                    <option value="{{ $item['id']??0 }}">{{ $item['name']??0 }}</option>
                @endforeach
                
                
            </select>
           </div>

            <div class="col-md-3">
            <button class="btn filter-btn" onclick="bookingFilter()">{{ __('lang.filter') }}</button>
            </div>
        <div class="col-md-3" style="text-align: start; margin : 20px">
            <h3>{{ __('lang.total_cost') }}:</h3>
            <div id="booking_total_cost"></div>
        </div>
        </div>
       </div>
       <div class="col-lg-12 col-md-6 col-12">
           <div class="card">
               <div class="card-header d-flex justify-content-between align-items-end">
                   <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
               </div>
               <div class="card-content">
                   <div class="card-body pb-0">
                       <div id="revenue-chart-3">

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>



 </section>
 <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>

  <script src="app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
 <script>

$(window).on("load", function () {
    // fetch('chart-years')
    $("#revenue-chart").html('');
    var categories = null;
    var thisMonth = null;
    var lastMonth = null;
    var RetainedClients = null;
    var NewClients = null;
    var months = null;
    var years = null;
    var revenue = null;
    fetch('chart-revenue-4').then(res => res.json()).then(data => {
        $("#revenue-chart").html('');
        console.log(data);
        years = data.days;
        revenue = data.rates;
        months = data.days;
        // lastMonth = data.lastMonth;
        // RetainedClients = data.RetainedClients;
        // NewClients = data.NewClients;
        // years = data.years;
        // console.log(thisMonth);
        var e = "#EDBF50",
        t = "#28C76F",
        a = "#EA5455",
        o = "#FF9F43",
        r = "#A9A2F6",
        s = "#f29292",
        i = "#ffc085",
        l = "#b9c3cd",
        n = "#e7e7e7",
        d = {
            chart: {
                height: 100,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                },
                grid: {
                    show: !1,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [e],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2.5
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: .9,
                    opacityFrom: .7,
                    opacityTo: .5,
                    stops: [0, 80, 100]
                }
            },
            series: [
                {
                    name: "Subscribers",
                    data: revenue
                }
            ],
            xaxis: {
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: [
                {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            ],
            tooltip: {
                x: {
                    show: !1
                }
            }
        };
        // document.getElementById("line-area-chart-1").innerHTML = "";
    new ApexCharts(document.querySelector("#line-area-chart-1"), d).render();
    var h = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [t],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Revenue",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-2").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-2"), h).render();
    var c = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [a],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Sales",
                data: revenue
            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-3").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-3"), c).render();
    var p = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [o],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Orders",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-4").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-4"), p).render();
    var g = {
        chart: {
            height: 270,
            toolbar: {
                show: !1
            },
            type: "line"
        },
        stroke: {
            curve: "smooth",
            dashArray: [
                0, 8
            ],
            width: [4, 2]
        },
        grid: {
            borderColor: n
        },
        legend: {
            show: !1
        },
        colors: [
            s, l
        ],
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                inverseColors: !1,
                gradientToColors: [
                    e, l
                ],
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 0,
            hover: {
                size: 5
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
             categories: years

            ,
            axisBorder: {
                show: !1
            },
            tickPlacement: "on"
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                },

            }
        },
        tooltip: {
            x: {
                show: !1
            }
        },
        series: [
            {
                name: "YEAR",
                data: revenue

            }
        ]
    };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart"), g).render();
    var y = {
        chart: {
            height: 250,
            type: "radialBar",
            sparkline: {
                enabled: !0
            },
            dropShadow: {
                enabled: !0,
                blur: 3,
                left: 1,
                top: 1,
                opacity: .1
            }
        },
        colors: [t],
        plotOptions: {
            radialBar: {
                size: 110,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: "77%"
                },
                track: {
                    background: l,
                    strokeWidth: "50%"
                },
                dataLabels: {
                    name: {
                        show: !1
                    },
                    value: {
                        offsetY: 18,
                        color: "#99a2ac",
                        fontSize: "4rem"
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: .5,
                gradientToColors: ["#00b5b5"],
                inverseColors: !0,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        series: [83],
        stroke: {
            lineCap: "round"
        }
    };

    new ApexCharts(document.querySelector("#goal-overview-chart"), y).render();
    var w = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: months,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    var wy = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: years,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart"), w).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart-year"), wy).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#session-chart"), b).render();
    var f = {
        chart: {
            type: "pie",
            height: 330,
            dropShadow: {
                enabled: !1,
                blur: 5,
                left: 1,
                top: 1,
                opacity: .2
            },
            toolbar: {
                show: !1
            }
        },
        labels: [
            "New", "Returning", "Referrals"
        ],
        series: [
            690, 258, 149
        ],
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !1
        },
        stroke: {
            width: 5
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#customer-chart"), f).render()
    })

}),
$(window).on("load", function () {
    // fetch('chart-years')
    var categories = null;
    var thisMonth = null;
    var lastMonth = null;
    var RetainedClients = null;
    var NewClients = null;
    var months = null;
    var years = null;
    var revenue = null;
    fetch('chart-revenue-3').then(res => res.json()).then(data => {
        $('#revenue-chart-2').html('');
        console.log(data);
        years = data.days;
        revenue = data.rates;
        months = data.days;
        // lastMonth = data.lastMonth;
        // RetainedClients = data.RetainedClients;
        // NewClients = data.NewClients;
        // years = data.years;
        // console.log(thisMonth);
        var e = "#EDBF50",
        t = "#28C76F",
        a = "#EA5455",
        o = "#FF9F43",
        r = "#A9A2F6",
        s = "#f29292",
        i = "#ffc085",
        l = "#b9c3cd",
        n = "#e7e7e7",
        d = {
            chart: {
                height: 100,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                },
                grid: {
                    show: !1,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [e],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2.5
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: .9,
                    opacityFrom: .7,
                    opacityTo: .5,
                    stops: [0, 80, 100]
                }
            },
            series: [
                {
                    name: "Subscribers",
                    data: revenue
                }
            ],
            xaxis: {
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: [
                {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            ],
            tooltip: {
                x: {
                    show: !1
                }
            }
        };
        // document.getElementById("line-area-chart-1").innerHTML = "";
    new ApexCharts(document.querySelector("#line-area-chart-1"), d).render();
    var h = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [t],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Revenue",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-2").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-2"), h).render();
    var c = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [a],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Sales",
                data: revenue
            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-3").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-3"), c).render();
    var p = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [o],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Orders",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-4").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-4"), p).render();
    var g = {
        chart: {
            height: 270,
            toolbar: {
                show: !1
            },
            type: "line"
        },
        stroke: {
            curve: "smooth",
            dashArray: [
                0, 8
            ],
            width: [4, 2]
        },
        grid: {
            borderColor: n
        },
        legend: {
            show: !1
        },
        colors: [
            s, l
        ],
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                inverseColors: !1,
                gradientToColors: [
                    e, l
                ],
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 0,
            hover: {
                size: 5
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
             categories: years

            ,
            axisBorder: {
                show: !1
            },
            tickPlacement: "on"
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                },

            }
        },
        tooltip: {
            x: {
                show: !1
            }
        },
        series: [
            {
                name: "YEAR",
                data: revenue

            }
        ]
    };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-2"), g).render();
    var y = {
        chart: {
            height: 250,
            type: "radialBar",
            sparkline: {
                enabled: !0
            },
            dropShadow: {
                enabled: !0,
                blur: 3,
                left: 1,
                top: 1,
                opacity: .1
            }
        },
        colors: [t],
        plotOptions: {
            radialBar: {
                size: 110,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: "77%"
                },
                track: {
                    background: l,
                    strokeWidth: "50%"
                },
                dataLabels: {
                    name: {
                        show: !1
                    },
                    value: {
                        offsetY: 18,
                        color: "#99a2ac",
                        fontSize: "4rem"
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: .5,
                gradientToColors: ["#00b5b5"],
                inverseColors: !0,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        series: [83],
        stroke: {
            lineCap: "round"
        }
    };

    new ApexCharts(document.querySelector("#goal-overview-chart"), y).render();
    var w = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: months,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    var wy = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: years,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart"), w).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart-year"), wy).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#session-chart"), b).render();
    var f = {
        chart: {
            type: "pie",
            height: 330,
            dropShadow: {
                enabled: !1,
                blur: 5,
                left: 1,
                top: 1,
                opacity: .2
            },
            toolbar: {
                show: !1
            }
        },
        labels: [
            "New", "Returning", "Referrals"
        ],
        series: [
            690, 258, 149
        ],
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !1
        },
        stroke: {
            width: 5
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#customer-chart"), f).render()
    })

}),
$(window).on("load", function () {
    var categories = null;
    var thisMonth = null;
    var lastMonth = null;
    var RetainedClients = null;
    var NewClients = null;
    var months = null;
    var years = null;
    var revenue = null;
    fetch('chart-revenue-2').then(res => res.json()).then(data => {
        $("revenue-chart-3").html('');
        console.table(data);
        years = data.days;
        revenue = data.rates;
        months = data.months;
        // lastMonth = data.lastMonth;
        // RetainedClients = data.RetainedClients;
        // NewClients = data.NewClients;
        // years = data.years;
        // console.log(thisMonth);
        var e = "#EDBF50",
        t = "#28C76F",
        a = "#EA5455",
        o = "#FF9F43",
        r = "#A9A2F6",
        s = "#f29292",
        i = "#ffc085",
        l = "#b9c3cd",
        n = "#e7e7e7",
        d = {
            chart: {
                height: 100,
                type: "area",
                toolbar: {
                    show: !1
                },
                sparkline: {
                    enabled: !0
                },
                grid: {
                    show: !1,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [e],
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 2.5
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: .9,
                    opacityFrom: .7,
                    opacityTo: .5,
                    stops: [0, 80, 100]
                }
            },
            series: [
                {
                    name: "Subscribers",
                    data: revenue
                }
            ],
            xaxis: {
                labels: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: [
                {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            ],
            tooltip: {
                x: {
                    show: !1
                }
            }
        };
        // document.getElementById("line-area-chart-1").innerHTML = "";
    new ApexCharts(document.querySelector("#line-area-chart-1"), d).render();
    var h = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [t],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Revenue",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-2").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-2"), h).render();
    var c = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [a],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Sales",
                data: revenue
            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-3").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-3"), c).render();
    var p = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [o],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [
            {
                name: "Orders",
                data: revenue

            }
        ],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        ],
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    // document.getElementById("line-area-chart-4").innerHTML = "";

    new ApexCharts(document.querySelector("#line-area-chart-4"), p).render();
    var g = {
        chart: {
            height: 270,
            toolbar: {
                show: !1
            },
            type: "line"
        },
        stroke: {
            curve: "smooth",
            dashArray: [
                0, 8
            ],
            width: [4, 2]
        },
        grid: {
            borderColor: n
        },
        legend: {
            show: !1
        },
        colors: [
            s, l
        ],
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                inverseColors: !1,
                gradientToColors: [
                    e, l
                ],
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            }
        },
        markers: {
            size: 0,
            hover: {
                size: 5
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
             categories: years

            ,
            axisBorder: {
                show: !1
            },
            tickPlacement: "on"
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                },

            }
        },
        tooltip: {
            x: {
                show: !1
            }
        },
        series: [
            {
                name: "YEAR",
                data: revenue

            }
        ]
    };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-3"), g).render();
    var y = {
        chart: {
            height: 250,
            type: "radialBar",
            sparkline: {
                enabled: !0
            },
            dropShadow: {
                enabled: !0,
                blur: 3,
                left: 1,
                top: 1,
                opacity: .1
            }
        },
        colors: [t],
        plotOptions: {
            radialBar: {
                size: 110,
                startAngle: -150,
                endAngle: 150,
                hollow: {
                    size: "77%"
                },
                track: {
                    background: l,
                    strokeWidth: "50%"
                },
                dataLabels: {
                    name: {
                        show: !1
                    },
                    value: {
                        offsetY: 18,
                        color: "#99a2ac",
                        fontSize: "4rem"
                    }
                }
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: .5,
                gradientToColors: ["#00b5b5"],
                inverseColors: !0,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        series: [83],
        stroke: {
            lineCap: "round"
        }
    };

    new ApexCharts(document.querySelector("#goal-overview-chart"), y).render();
    var w = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: months,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    var wy = {
        chart: {
            stacked: !0,
            type: "bar",
            toolbar: {
                show: !1
            },
            height: 300
        },
        plotOptions: {
            bar: {
                columnWidth: "10%"
            }
        },
        colors: [
            e, a
        ],
        series: [
            {
                name: "New Clients",
                data: NewClients
            }, {
                name: "Retained Clients",
                data: RetainedClients
            }
        ],
        grid: {
            borderColor: n,
            padding: {
                left: 0,
                right: 0
            }
        },
        legend: {
            show: !0,
            position: "top",
            horizontalAlign: "left",
            offsetX: 0,
            fontSize: "14px",
            markers: {
                radius: 50,
                width: 10,
                height: 10
            }
        },
        dataLabels: {
            enabled: !1
        },
        xaxis: {
            labels: {
                style: {
                    colors: l
                }
            },
            axisTicks: {
                show: !1
            },
            categories: years,
            axisBorder: {
                show: !1
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    color: l
                }
            }
        },
        tooltip: {
            x: {
                show: !1
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart"), w).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#client-retention-chart-year"), wy).render();
    var b = {
        chart: {
            type: "donut",
            height: 325,
            toolbar: {
                show: !1
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [
            58.6, 34.9, 6.5
        ],
        legend: {
            show: !1
        },
        comparedResult: [
            2, -3, 8
        ],
        labels: [
            "Desktop", "Mobile", "Tablet"
        ],
        stroke: {
            width: 0
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#session-chart"), b).render();
    var f = {
        chart: {
            type: "pie",
            height: 330,
            dropShadow: {
                enabled: !1,
                blur: 5,
                left: 1,
                top: 1,
                opacity: .2
            },
            toolbar: {
                show: !1
            }
        },
        labels: [
            "New", "Returning", "Referrals"
        ],
        series: [
            690, 258, 149
        ],
        dataLabels: {
            enabled: !1
        },
        legend: {
            show: !1
        },
        stroke: {
            width: 5
        },
        colors: [
            e, o, a
        ],
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: [r, i, s]
            }
        }
    };
    new ApexCharts(document.querySelector("#customer-chart"), f).render()
    })

}),
// $(window).on("load", function () {
//     // fetch('chart-years')
//     var categories = null;
//     var thisMonth = null;
//     var lastMonth = null;
//     var RetainedClients = null;
//     var NewClients = null;
//     var months = null;
//     var years = null;
//     var revenue = null;
//     fetch('chart-years-1').then(res => res.json()).then(data => {
//         console.log(data);
//         years = data.years;
//         revenue = data.rates;
//         months = data.months;
//         // lastMonth = data.lastMonth;
//         // RetainedClients = data.RetainedClients;
//         // NewClients = data.NewClients;
//         // years = data.years;
//         // console.log(thisMonth);
//         var e = "#EDBF50",
//         t = "#28C76F",
//         a = "#EA5455",
//         o = "#FF9F43",
//         r = "#A9A2F6",
//         s = "#f29292",
//         i = "#ffc085",
//         l = "#b9c3cd",
//         n = "#e7e7e7",
//         d = {
//             chart: {
//                 height: 100,
//                 type: "area",
//                 toolbar: {
//                     show: !1
//                 },
//                 sparkline: {
//                     enabled: !0
//                 },
//                 grid: {
//                     show: !1,
//                     padding: {
//                         left: 0,
//                         right: 0
//                     }
//                 }
//             },
//             colors: [e],
//             dataLabels: {
//                 enabled: !1
//             },
//             stroke: {
//                 curve: "smooth",
//                 width: 2.5
//             },
//             fill: {
//                 type: "gradient",
//                 gradient: {
//                     shadeIntensity: .9,
//                     opacityFrom: .7,
//                     opacityTo: .5,
//                     stops: [0, 80, 100]
//                 }
//             },
//             series: [
//                 {
//                     name: "Subscribers",
//                     data: revenue
//                 }
//             ],
//             xaxis: {
//                 labels: {
//                     show: !1
//                 },
//                 axisBorder: {
//                     show: !1
//                 }
//             },
//             yaxis: [
//                 {
//                     y: 0,
//                     offsetX: 0,
//                     offsetY: 0,
//                     padding: {
//                         left: 0,
//                         right: 0
//                     }
//                 }
//             ],
//             tooltip: {
//                 x: {
//                     show: !1
//                 }
//             }
//         };
//         // document.getElementById("line-area-chart-1").innerHTML = "";
//     new ApexCharts(document.querySelector("#line-area-chart-1"), d).render();
//     var h = {
//         chart: {
//             height: 100,
//             type: "area",
//             toolbar: {
//                 show: !1
//             },
//             sparkline: {
//                 enabled: !0
//             },
//             grid: {
//                 show: !1,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         },
//         colors: [t],
//         dataLabels: {
//             enabled: !1
//         },
//         stroke: {
//             curve: "smooth",
//             width: 2.5
//         },
//         fill: {
//             type: "gradient",
//             gradient: {
//                 shadeIntensity: .9,
//                 opacityFrom: .7,
//                 opacityTo: .5,
//                 stops: [0, 80, 100]
//             }
//         },
//         series: [
//             {
//                 name: "Revenue",
//                 data: revenue

//             }
//         ],
//         xaxis: {
//             labels: {
//                 show: !1
//             },
//             axisBorder: {
//                 show: !1
//             }
//         },
//         yaxis: [
//             {
//                 y: 0,
//                 offsetX: 0,
//                 offsetY: 0,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         ],
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         }
//     };
//     // document.getElementById("line-area-chart-2").innerHTML = "";

//     new ApexCharts(document.querySelector("#line-area-chart-2"), h).render();
//     var c = {
//         chart: {
//             height: 100,
//             type: "area",
//             toolbar: {
//                 show: !1
//             },
//             sparkline: {
//                 enabled: !0
//             },
//             grid: {
//                 show: !1,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         },
//         colors: [a],
//         dataLabels: {
//             enabled: !1
//         },
//         stroke: {
//             curve: "smooth",
//             width: 2.5
//         },
//         fill: {
//             type: "gradient",
//             gradient: {
//                 shadeIntensity: .9,
//                 opacityFrom: .7,
//                 opacityTo: .5,
//                 stops: [0, 80, 100]
//             }
//         },
//         series: [
//             {
//                 name: "Sales",
//                 data: revenue
//             }
//         ],
//         xaxis: {
//             labels: {
//                 show: !1
//             },
//             axisBorder: {
//                 show: !1
//             }
//         },
//         yaxis: [
//             {
//                 y: 0,
//                 offsetX: 0,
//                 offsetY: 0,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         ],
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         }
//     };
//     // document.getElementById("line-area-chart-3").innerHTML = "";

//     new ApexCharts(document.querySelector("#line-area-chart-3"), c).render();
//     var p = {
//         chart: {
//             height: 100,
//             type: "area",
//             toolbar: {
//                 show: !1
//             },
//             sparkline: {
//                 enabled: !0
//             },
//             grid: {
//                 show: !1,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         },
//         colors: [o],
//         dataLabels: {
//             enabled: !1
//         },
//         stroke: {
//             curve: "smooth",
//             width: 2.5
//         },
//         fill: {
//             type: "gradient",
//             gradient: {
//                 shadeIntensity: .9,
//                 opacityFrom: .7,
//                 opacityTo: .5,
//                 stops: [0, 80, 100]
//             }
//         },
//         series: [
//             {
//                 name: "Orders",
//                 data: revenue

//             }
//         ],
//         xaxis: {
//             labels: {
//                 show: !1
//             },
//             axisBorder: {
//                 show: !1
//             }
//         },
//         yaxis: [
//             {
//                 y: 0,
//                 offsetX: 0,
//                 offsetY: 0,
//                 padding: {
//                     left: 0,
//                     right: 0
//                 }
//             }
//         ],
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         }
//     };
//     // document.getElementById("line-area-chart-4").innerHTML = "";

//     new ApexCharts(document.querySelector("#line-area-chart-4"), p).render();
//     var g = {
//         chart: {
//             height: 270,
//             toolbar: {
//                 show: !1
//             },
//             type: "line"
//         },
//         stroke: {
//             curve: "smooth",
//             dashArray: [
//                 0, 8
//             ],
//             width: [4, 2]
//         },
//         grid: {
//             borderColor: n
//         },
//         legend: {
//             show: !1
//         },
//         colors: [
//             s, l
//         ],
//         fill: {
//             type: "gradient",
//             gradient: {
//                 shade: "dark",
//                 inverseColors: !1,
//                 gradientToColors: [
//                     e, l
//                 ],
//                 shadeIntensity: 1,
//                 type: "horizontal",
//                 opacityFrom: 1,
//                 opacityTo: 1,
//                 stops: [0, 100, 100, 100]
//             }
//         },
//         markers: {
//             size: 0,
//             hover: {
//                 size: 5
//             }
//         },
//         xaxis: {
//             labels: {
//                 style: {
//                     colors: l
//                 }
//             },
//             axisTicks: {
//                 show: !1
//             },
//              categories: years

//             ,
//             axisBorder: {
//                 show: !1
//             },
//             tickPlacement: "on"
//         },
//         yaxis: {
//             tickAmount: 5,
//             labels: {
//                 style: {
//                     color: l
//                 },

//             }
//         },
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         },
//         series: [
//             {
//                 name: "YEAR",
//                 data: revenue

//             }
//         ]
//     };
//     // document.getElementById("revenue-chart").innerHTML = "";

//     new ApexCharts(document.querySelector("#revenue-chart-4"), g).render();
//     var y = {
//         chart: {
//             height: 250,
//             type: "radialBar",
//             sparkline: {
//                 enabled: !0
//             },
//             dropShadow: {
//                 enabled: !0,
//                 blur: 3,
//                 left: 1,
//                 top: 1,
//                 opacity: .1
//             }
//         },
//         colors: [t],
//         plotOptions: {
//             radialBar: {
//                 size: 110,
//                 startAngle: -150,
//                 endAngle: 150,
//                 hollow: {
//                     size: "77%"
//                 },
//                 track: {
//                     background: l,
//                     strokeWidth: "50%"
//                 },
//                 dataLabels: {
//                     name: {
//                         show: !1
//                     },
//                     value: {
//                         offsetY: 18,
//                         color: "#99a2ac",
//                         fontSize: "4rem"
//                     }
//                 }
//             }
//         },
//         fill: {
//             type: "gradient",
//             gradient: {
//                 shade: "dark",
//                 type: "horizontal",
//                 shadeIntensity: .5,
//                 gradientToColors: ["#00b5b5"],
//                 inverseColors: !0,
//                 opacityFrom: 1,
//                 opacityTo: 1,
//                 stops: [0, 100]
//             }
//         },
//         series: [83],
//         stroke: {
//             lineCap: "round"
//         }
//     };

//     new ApexCharts(document.querySelector("#goal-overview-chart"), y).render();
//     var w = {
//         chart: {
//             stacked: !0,
//             type: "bar",
//             toolbar: {
//                 show: !1
//             },
//             height: 300
//         },
//         plotOptions: {
//             bar: {
//                 columnWidth: "10%"
//             }
//         },
//         colors: [
//             e, a
//         ],
//         series: [
//             {
//                 name: "New Clients",
//                 data: NewClients
//             }, {
//                 name: "Retained Clients",
//                 data: RetainedClients
//             }
//         ],
//         grid: {
//             borderColor: n,
//             padding: {
//                 left: 0,
//                 right: 0
//             }
//         },
//         legend: {
//             show: !0,
//             position: "top",
//             horizontalAlign: "left",
//             offsetX: 0,
//             fontSize: "14px",
//             markers: {
//                 radius: 50,
//                 width: 10,
//                 height: 10
//             }
//         },
//         dataLabels: {
//             enabled: !1
//         },
//         xaxis: {
//             labels: {
//                 style: {
//                     colors: l
//                 }
//             },
//             axisTicks: {
//                 show: !1
//             },
//             categories: months,
//             axisBorder: {
//                 show: !1
//             }
//         },
//         yaxis: {
//             tickAmount: 5,
//             labels: {
//                 style: {
//                     color: l
//                 }
//             }
//         },
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         }
//     };
//     var wy = {
//         chart: {
//             stacked: !0,
//             type: "bar",
//             toolbar: {
//                 show: !1
//             },
//             height: 300
//         },
//         plotOptions: {
//             bar: {
//                 columnWidth: "10%"
//             }
//         },
//         colors: [
//             e, a
//         ],
//         series: [
//             {
//                 name: "New Clients",
//                 data: NewClients
//             }, {
//                 name: "Retained Clients",
//                 data: RetainedClients
//             }
//         ],
//         grid: {
//             borderColor: n,
//             padding: {
//                 left: 0,
//                 right: 0
//             }
//         },
//         legend: {
//             show: !0,
//             position: "top",
//             horizontalAlign: "left",
//             offsetX: 0,
//             fontSize: "14px",
//             markers: {
//                 radius: 50,
//                 width: 10,
//                 height: 10
//             }
//         },
//         dataLabels: {
//             enabled: !1
//         },
//         xaxis: {
//             labels: {
//                 style: {
//                     colors: l
//                 }
//             },
//             axisTicks: {
//                 show: !1
//             },
//             categories: years,
//             axisBorder: {
//                 show: !1
//             }
//         },
//         yaxis: {
//             tickAmount: 5,
//             labels: {
//                 style: {
//                     color: l
//                 }
//             }
//         },
//         tooltip: {
//             x: {
//                 show: !1
//             }
//         }
//     };
//     new ApexCharts(document.querySelector("#client-retention-chart"), w).render();
//     var b = {
//         chart: {
//             type: "donut",
//             height: 325,
//             toolbar: {
//                 show: !1
//             }
//         },
//         dataLabels: {
//             enabled: !1
//         },
//         series: [
//             58.6, 34.9, 6.5
//         ],
//         legend: {
//             show: !1
//         },
//         comparedResult: [
//             2, -3, 8
//         ],
//         labels: [
//             "Desktop", "Mobile", "Tablet"
//         ],
//         stroke: {
//             width: 0
//         },
//         colors: [
//             e, o, a
//         ],
//         fill: {
//             type: "gradient",
//             gradient: {
//                 gradientToColors: [r, i, s]
//             }
//         }
//     };
//     new ApexCharts(document.querySelector("#client-retention-chart-year"), wy).render();
//     var b = {
//         chart: {
//             type: "donut",
//             height: 325,
//             toolbar: {
//                 show: !1
//             }
//         },
//         dataLabels: {
//             enabled: !1
//         },
//         series: [
//             58.6, 34.9, 6.5
//         ],
//         legend: {
//             show: !1
//         },
//         comparedResult: [
//             2, -3, 8
//         ],
//         labels: [
//             "Desktop", "Mobile", "Tablet"
//         ],
//         stroke: {
//             width: 0
//         },
//         colors: [
//             e, o, a
//         ],
//         fill: {
//             type: "gradient",
//             gradient: {
//                 gradientToColors: [r, i, s]
//             }
//         }
//     };
//     new ApexCharts(document.querySelector("#session-chart"), b).render();
//     var f = {
//         chart: {
//             type: "pie",
//             height: 330,
//             dropShadow: {
//                 enabled: !1,
//                 blur: 5,
//                 left: 1,
//                 top: 1,
//                 opacity: .2
//             },
//             toolbar: {
//                 show: !1
//             }
//         },
//         labels: [
//             "New", "Returning", "Referrals"
//         ],
//         series: [
//             690, 258, 149
//         ],
//         dataLabels: {
//             enabled: !1
//         },
//         legend: {
//             show: !1
//         },
//         stroke: {
//             width: 5
//         },
//         colors: [
//             e, o, a
//         ],
//         fill: {
//             type: "gradient",
//             gradient: {
//                 gradientToColors: [r, i, s]
//             }
//         }
//     };
//     new ApexCharts(document.querySelector("#customer-chart"), f).render()
//     })

// }),



    

    function months(val){
        $('#revenue-chart').html('');
       console.log(val);
       localStorage.setItem('year', val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-4?year=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let Months = res.months;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector').append(x) ;

    }
    function monthsDays(val) {
        $('#revenue-chart').html('');
        console.log(val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-4?year=${localStorage.getItem('year')}&month=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let days = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: days

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart"), g).render();

            }
        })
    }
    function months3(val)
    {
        $('#revenue-chart-2').html('');

        console.log(val);
       localStorage.setItem('year', val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-3?year=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let Months = res.months;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-2"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector3').append(x) ;

    }
    function monthsDays3(val) {
        $('#revenue-chart-2').html('');
        console.log(val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-3?year=${localStorage.getItem('year')}&month=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let days = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: days

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-2"), g).render();

            }
        })
    }
    function bookingFilter()
    {
        from=$("#booking_from").val();
        to=$("#booking_to").val();
        status=$("#booking_status").val();
        service=$("#booking_service").val();
       
        $('#revenue-chart-3').html('');
       
    //    localStorage.setItem('year', val);
    //    // Get Values Of Year
        $.ajax({
            url: `chart-revenue-2?from=${from}&to=${to}&status=${status}&service=${service}`,
            type: 'get',
            success:function(res) {
                
                $("#booking_total_cost").html(res.totalCost)
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                
                years = res.days;
                revenue = res.rates;
                months = res.days;
                console.log(revenue);
                let Months = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-3"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector2').append(x) ;

    }
    function monthsDays2(val) {
        $('#revenue-chart-3').html('');
        console.log(val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-2?year=${localStorage.getItem('year')}&month=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let days = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: days

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-3"), g).render();

            }
        })
    }
    function months1(val)
    {
       console.log(val);
       localStorage.setItem('year', val);
       // Get Values Of Year
        $.ajax({
            url: `chart-months-1?year=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let Months = res.months;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-4"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector1').append(x) ;

    }
    function monthsDays1(val) {
        console.log(val);
       // Get Values Of Year
        $.ajax({
            url: `chart-revenue-1?year=${localStorage.getItem('year')}&month=${val}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                console.log(revenue);
                let days = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: days

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            };
    // document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-4"), g).render();

            }
        })
    }


  
function paymentFilter(){
        
        $('#revenue-chart').html('');
        document.getElementById("revenue-chart").innerHTML = "";
        from=$("#payments_from").val();
        to=$("#payments_end").val();
        
        $.ajax({
            url: `/chart-revenue-4?from=${from}&to=${to}`,
            type: 'get',
            success:function(res) {
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                let Months = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            }
        
        
    document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector').append(x) ;

}  



function userFilter(){
    $('#revenue-chart-2').html('');
        document.getElementById("revenue-chart").innerHTML = "";
        from=$("#users_from").val();
        to=$("#users_end").val();
        
        $.ajax({
            url: `/chart-revenue-3?from=${from}&to=${to}`,
            type: 'get',
            success:function(res) {
        
                var e = "#EDBF50",
                t = "#28C76F",
                a = "#EA5455",
                o = "#FF9F43",
                r = "#A9A2F6",
                s = "#f29292",
                i = "#ffc085",
                l = "#b9c3cd",
                n = "#e7e7e7"
                console.log(res)
                // years
                revenue = res.rates;
                let Months = res.days;
            var g = {
                chart: {
                    height: 270,
                    toolbar: {
                        show: !1
                    },
                    type: "line"
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [
                        0, 8
                    ],
                    width: [4, 2]
                },
                grid: {
                    borderColor: n
                },
                legend: {
                    show: !1
                },
                colors: [
                    s, l
                ],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        inverseColors: !1,
                        gradientToColors: [
                            e, l
                        ],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: l
                        }
                    },
                    axisTicks: {
                        show: !1
                    },
                    categories: Months

                    ,
                    axisBorder: {
                        show: !1
                    },
                    tickPlacement: "on"
                },
                yaxis: {
                    tickAmount: 5,
                    labels: {
                        style: {
                            color: l
                        },

                    }
                },
                tooltip: {
                    x: {
                        show: !1
                    }
                },
                series: [
                    {
                        name: "YEAR",
                        data: revenue

                    }
                ]
            }
        
        
    document.getElementById("revenue-chart").innerHTML = "";

    new ApexCharts(document.querySelector("#revenue-chart-2"), g).render();

            }
        })
       // All Months
        var x = `<option value="1">{{__('lang.January')}}</option>
                <option value="2">{{__('lang.February')}}</option>
                <option value="3">{{__('lang.March')}}</option>
                <option value="4">{{__('lang.April')}}</option>
                <option value="5">{{__('lang.May')}}</option>
                <option value="6">{{__('lang.June')}}</option>
                <option value="7">{{__('lang.July')}}</option>
                <option value="8">{{__('lang.August')}}</option>
                <option value="9">{{__('lang.September')}}</option>
                <option value="10">{{__('lang.October')}}</option>
                <option value="11">{{__('lang.November')}}</option>
                <option value="12">{{__('lang.December')}}</option>
            ` ;
        $('#month_selector').append(x) ;

}
function filterCards(){

        // alert($("#product-id").val());
        let ok = false ;
        $( ".solid_filter" ).each(function() {
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
        // alert($('#imageVal').val())
        // return ;
        let fd = {
            _token: '{{ csrf_token() }}',
            from:$("#cards_from").val(),
            to:$("#cards_end").val(),

            

        }
       
        $.ajax({
            url: "filter-cards",
            method: 'POST',
            data: fd,

            success: function(res) {
                $("#products-table").DataTable().ajax.reload();

                 if(res.code == 200){
                    console.clear()
                    
                    $("#cancelled_booking_user_card").html(res.cancelled_bookings_user);
                    $("#cancelled_booking_vendor_card").html(res.cancelled_bookings_vendor);
                    $("#completed_booking_vendor_card").html(res.completed_bookings_vendor);
                    $("#notshown_booking_card").html(res.notshown_bookings);
                    $("#pending_booking_card").html(res.pending_bookings);
                    $("#service_card").html(res.services);
                    $("#sub_service_card").html(res.sub_services);
                    $("#user_card").html(res.users);
                    $("#vendor_card").html(res.vendors);
                    
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
</script>
 

 @endsection
