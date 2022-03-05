@extends("layouts.seller")
@section('seller_css')
<link href="{{ asset('assets/backend/style/css/jquery-ui.css') }}" rel = "stylesheet">
<style type="text/css">
  .ui-widget-header{
    border: #ddd solid red !important;
    background: #000 !important
  }
</style>

@endsection
@section("seller_title","DPG Seller | Custom Report")
@section("seller_breadcrumb",trans('seller.custom_report'))
@section("seller_content")

  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  
                  <form action="{{ route('seller.generate_report') }}" method="post">
                    @csrf
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group">
                                  <label>@lang('seller.start_date')</label>
                                  <input type="text" class="form-control" name="start_date" id="start_date" required>
                                  
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>@lang('seller.end_date')</label>
                                  <input type="text" class="form-control" name="end_date" id="end_date" required>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-primary" type="submit">@lang('seller.generate_report')</button>
                  </form>
              </div>
          </div>
          <!-- end card -->
      </div> 
  </div>

  @if ($my_orders !=null)
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
          <span><strong><h5>@lang('seller.seller_amount'): {{currency().number_format($total_earning,2)}}</h5></strong></span>
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
                       
                        <h4 class="mt-0 header-title">@lang('seller.custom_report')</h4>
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
  
  @endif
@endsection
@section('seller_js')
<script src = "{{ asset('assets/backend/style/js/jquery-ui.js') }}"></script>
  <script>
    $(document).ready(function(){
          $('#datatable_table').DataTable();

            $( "#start_date" ).datepicker({
                  maxDate: new Date(), 
            });
            $( "#end_date" ).datepicker({
                  maxDate: new Date()    
            });
    });
  </script>
@endsection
