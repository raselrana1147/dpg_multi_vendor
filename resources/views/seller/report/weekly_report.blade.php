@extends("layouts.seller")
@section("seller_title","DPG Seller | Weekly Report")
@section("seller_breadcrumb",trans('seller.weekly_report'))
@section("seller_content")

 <div class="card">
     <div class="row">
     <div class="col-3">
       <span><strong><h5>@lang('seller.total_sale'): {{currency().number_format($total_sale,2)}}</h5></strong></span>
     </div>
     <div class="col-3">
       <span><strong><h5>@lang('seller.total_order'): {{$total_seller_order}}</h5></strong></span>
     </div>
     <div class="col-3">
       <span><strong><h5>@lang('seller.total_sold_item'): {{$total_seller_quantity}}</h5></strong></span>
     </div>
     <div class="col-3">
       <span><strong><h5>@lang('seller.seller_amount'): {{currency().number_format($provided_commission,2)}}</h5></strong></span>
     </div>

     <div class="col-3">
       <span><strong><h5>@lang('seller.company_commission'): {{currency().number_format($provided_commission,2)}}</h5></strong></span>
     </div>
     </div>
   </div>
 


  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  
                   <h4 class="mt-0 header-title">@lang('seller.weekly_report')</h4>
                  <table id="datatable_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                      <tr>
                          <th>@lang('seller.serial')</th>
                          <th>@lang('seller.order_number')</th>
                          <th>@lang('seller.sub_total')</th>
                          <th>@lang('seller.order_at')</th>
                          <th>@lang('seller.status')</th>
                      </tr>
                      </thead>
                      <tbody>
                       @foreach ($my_orders as $order)
                       
                        <tr>
                          <td>{{$loop->index+1}}</td>
                          <td><a href="{{ route('seller.order_detail',$order['id']) }}">#{{$order['order_number']}}</a></td>
                          <td>{{currency().number_format($order['unit_total_price'],2)}}</td>
                          <td>{{$order['created_at']}}</td>
                          <td>{{$order['status']}}</td>              
                        </tr>

                     @endforeach
                     
                      </tbody>
                      
                  </table>
  
              </div>
          </div>
      </div> <!-- end col -->
  </div> <!-- end row -->
  
@endsection
@section('seller_js')
  <script>
    $(document).ready(function(){
          $('#datatable_table').DataTable();
    });
  </script>
@endsection
