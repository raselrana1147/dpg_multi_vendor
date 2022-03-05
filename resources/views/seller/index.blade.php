@extends("layouts.seller")
@section("seller_title","DPG Seller | Dashboard")
@section("seller_breadcrumb",trans('seller.dashboard'))
@section("seller_content")
   <div class="row">
       <div class="col-lg-3">
           <div class="card mini-stat bg-pattern">
               <div class="card-body mini-stat-img">
                   <div class="mini-stat-icon">
                       <i class="dripicons-broadcast bg-soft-primary text-primary float-right h4"></i>
                   </div>
                   <h6 class="text-uppercase mb-3 mt-0">@lang('seller.total_order')</h6>
                   <h5 class="mb-3">{{number_format(count($orders))}}</h5>
                  
               </div>
           </div>
       </div>


        <div class="col-lg-3">
           <div class="card mini-stat bg-pattern">
               <div class="card-body mini-stat-img">
                   <div class="mini-stat-icon">
                       <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                   </div>
                   <h6 class="text-uppercase mb-3 mt-0">@lang('seller.total_product')</h6>
                   <h5 class="mb-3">{{number_format($total_product)}}</h5>
               </div>
           </div>
       </div>
       <div class="col-lg-3">
           <div class="card mini-stat bg-pattern">
               <div class="card-body mini-stat-img">
                   <div class="mini-stat-icon">
                       <i class="dripicons-box bg-soft-primary text-primary float-right h4"></i>
                   </div>
                   <h6 class="text-uppercase mb-3 mt-0">@lang('seller.total_sale')</h6>
                   <h5 class="mb-3">{{currency()}}{{number_format($total_sale,2)}}</h5>
                  
               </div>
           </div>
       </div>
       <div class="col-lg-3">
           <div class="card mini-stat bg-pattern">
               <div class="card-body mini-stat-img">
                   <div class="mini-stat-icon">
                       <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                   </div>
                   <h6 class="text-uppercase mb-3 mt-0">@lang('seller.pending_amount')</h6>
                   <h5 class="mb-3">{{currency()}}{{number_format($pending_amount,2)}}</h5>
                   
                  
               </div>
           </div>
       </div>

       
   </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('seller.overall_order_status')</h4>
                   <canvas id="SellerPieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('seller.monthly_order_report')</h4>
                    <canvas id="SellerBarChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
       <div class="col-xl-6">
           <div class="card">
               <div class="card-body">
                   <h4 class="mt-0 header-title mb-4">@lang('seller.latest_order')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('seller.serial')</th>
                           <th>@lang('seller.order_number')</th>
                           <th>@lang('seller.amount')</th>
                           <th>@lang('seller.order_at')</th>
                           <th>@lang('seller.status')</th>
                       </tr>
                       </thead>
                       <tbody>
                           @foreach ($orders as $order)
                             
                           <tr>
                               <td>{{$loop->index+1}}</td>
                               <td><a href="{{ route('seller.order_detail',$order->id) }}">{{$order->order_number}}</a></td>
                               <td>{{currency().number_format($order->sub_total,2)}}</td>
                               <td>{{date('d-m-Y',strtotime($order->sub_total))}}</td>
                               <td><span class="badge badge-success p-1">{{$order->status}}</span></td>
                           </tr>
                            @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('seller.latest_product')</h4>
                    <canvas id="SellerBarChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('seller_js')
<script src="{{ asset('assets/backend/style/js/chart.js') }}"></script>
<script>
    

      
        var xValues = ["pending",'processing','confirmed','delivered','declined'];
        var yValues = [
                        @php echo $product_order_status['pending']; @endphp,
                        @php echo $product_order_status['processing']; @endphp,
                        @php echo $product_order_status['confirmed']; @endphp,
                        @php echo $product_order_status['delivered']; @endphp,
                        @php echo $product_order_status['declined']; @endphp
                       
                       ];
        var barColors = ["#b91d47","#00aba9","#2b5797","#e8c3b9", "#1e7145"];

        new Chart("SellerPieChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "@lang('seller.order_status_symbol')"
            }
          }
        });


    var xValues = ["Jan", "Fab", "March", "April", "May","June","July","Aug","Sept","Oct","Nov","Dec"];
    var yValues = [
                    @php echo $getBarChart['jan_amount']; @endphp,
                    @php echo $getBarChart['feb_amount']; @endphp,
                    @php echo $getBarChart['mar_amount']; @endphp,
                    @php echo $getBarChart['april_amount']; @endphp,
                    @php echo $getBarChart['may_amount']; @endphp,
                    @php echo $getBarChart['june_amount']; @endphp,
                    @php echo $getBarChart['july_amount']; @endphp,
                    @php echo $getBarChart['august_amount']; @endphp,
                    @php echo $getBarChart['sept_amount']; @endphp,
                    @php echo $getBarChart['oct_amount']; @endphp,
                    @php echo $getBarChart['nov_amount']; @endphp,
                    @php echo $getBarChart['dec_amount']; @endphp
            ];
    var barColors = ["#FF9933", "#669900","#000033","#669900","#CC0099","#D35400","#AD1457","#1F618D","#A93226","#7B1FA2","#FF5733","#512E5F"];

    new Chart("SellerBarChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
            title: {
              display: true,
              text: "@lang('seller.yearly_seling_report')"
            }
       }
    });
     
    </script>



@endsection