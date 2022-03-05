@extends("layouts.admin")
@section("title","DPG Admin | Dashboard")
@section("breadcrumb","Dashboard")
@section("content")
    <div class="row">
        <div class="col-lg-3">
            <div class="card mini-stat bg-pattern">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="dripicons-broadcast bg-soft-primary text-primary float-right h4"></i>
                    </div>
                    <h6 class="text-uppercase mb-3 mt-0">@lang('admin.total_order')</h6>
                    <h5 class="mb-3">{{number_format($total_order)}}</h5>
                   
                </div>
            </div>
        </div>


         <div class="col-lg-3">
            <div class="card mini-stat bg-pattern">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                    </div>
                    <h6 class="text-uppercase mb-3 mt-0">@lang('admin.total_sale')</h6>
                    <h5 class="mb-3">{{currency().number_format($total_sell,2)}}</h5>
                    
                   
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mini-stat bg-pattern">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="dripicons-box bg-soft-primary text-primary float-right h4"></i>
                    </div>
                    <h6 class="text-uppercase mb-3 mt-0">@lang('admin.total_commission')</h6>
                    <h5 class="mb-3">{{currency().number_format($order_commission,2)}}</h5>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mini-stat bg-pattern">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="dripicons-tags bg-soft-primary text-primary float-right h4"></i>
                    </div>
                    <h6 class="text-uppercase mb-3 mt-0">@lang('admin.total_seller_amount')</h6>
                    <h5 class="mb-3">{{currency().number_format($seller_amount,2)}}</h5>
                    
                   
                </div>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('admin.overall_order_status')</h4>
                   <canvas id="AdminPieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('admin.monthly_order_report')</h4>
                    
                    <canvas id="AdminBarChart" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>
    </div>

  

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('admin.latest_product')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.product_name')</th>
                           <th>@lang('admin.thumbnail')</th>
                           <th>@lang('admin.price')</th>
                       </tr>
                       </thead>

                       <tbody>
                           @foreach ($new_products as $new_product)
                             
                           <tr>
                               <td>{{$loop->index+1}}</td>
                               <td><a href="{{ route('product.detail',$new_product->id)}}" target="_blank">{{$new_product->name}}</a></td>
                               <td><img src="{{ asset('assets/backend/image/product/small/'.$new_product->thumbnail) }}" style="width: 50px;height: 25px"></td>
                               <td>{{currency().number_format($new_product->current_price,2)}}</td>
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
                    <h4 class="mt-0 header-title mb-4">@lang('admin.latest_order')</h4>
                    <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>@lang('admin.serial')</th>
                            <th>@lang('admin.order_number')</th>
                            <th>@lang('admin.amount')</th>
                            <th>@lang('admin.order_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($new_orders as $new_order)
                              
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td><a href="{{ route('admin.order_detail',$new_order->id) }}">{{$new_order->order_number}}</a></td>
                                <td>{{currency().number_format($new_order->sub_total,2)}}</td>
                                <td>{{date('d-m-Y',strtotime($new_order->sub_total))}}</td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">@lang('admin.latest_category')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.category')</th>
                           <th>@lang('admin.image')</th>
                       </tr>
                       </thead>

                       <tbody>
                           @foreach ($new_categories as $new_category)
                          <tr>
                              <td>{{$loop->index+1}}</td>
                              <td>{{$new_category->category_name}}</td>
                                <td><img src="{{  $new_category->image !=null ? asset('assets/backend/image/category/small/'.$new_category->image) : asset('assets/backend/image/'.default_image()) }}" style="width: 50px;height: 25px"></td>
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
                    <h4 class="mt-0 header-title mb-4">@lang('admin.latest_brand')</h4>
                    <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>@lang('admin.serial')</th>
                            <th>@lang('admin.brand_name')</th>
                            <th>@lang('admin.image')</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($new_brands as $new_brand)
                              
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$new_brand->brand_name}}</td>
                                  <td><img src="{{  $new_brand->image !=null ? asset('assets/backend/image/brand/small/'.$new_brand->image) : asset('assets/backend/image/'.default_image()) }}" style="width: 50px;height: 25px"></td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
@endsection
@section('js')
<script src="{{ asset('assets/backend/style/js/chart.js') }}"></script>
<script>
  
    var xValues = [@foreach ($orders as $key=> $val)"{{ $val->status}}", @endforeach];
    var yValues = [@foreach ($orders as $val)"{{ $val->total}}",@endforeach];
    var barColors = ["#b91d47","#00aba9","#2b5797","#e8c3b9", "#1e7145"];

    new Chart("AdminPieChart", {
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
          text: "@lang('admin.order_status_symbol')"
        }
      }
    });


var xValues = ["Jan", "Fab", "March", "March", "May","June","July","Aug","Sept","Oct","Nov","Dec"];
var yValues = [@for ($i = 0; $i <12 ; $i++){{$month_salling[$i]}}{{ $i!=11 ? ",": ""}}@endfor];
 var barColors = ["#FF9933", "#669900","#000033","#669900","#CC0099","#D35400","#AD1457","#1F618D","#A93226","#7B1FA2","#FF5733","#512E5F"];


new Chart("AdminBarChart", {
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
          text: "@lang('admin.yearly_seling_report')"
        }
}
});
 
</script>
@endsection