@extends("layouts.admin")
@section('css')
<link href="{{ asset('assets/backend/style/css/jquery-ui.css') }}" rel = "stylesheet">
<style type="text/css">
  .ui-widget-header{
    border: #ddd solid red !important;
    background: #000 !important
  }
</style>

@endsection
@section("title","DPG Admin | Custom Report")
@section("breadcrumb",trans('admin.custom_report'))
@section("content")

  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  
                  <form action="{{ route('admin.generate_report') }}" method="post">
                    @csrf
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group">
                                  <label>@lang('admin.start_date')</label>
                                  <input type="text" class="form-control" name="start_date" id="start_date" required>
                                  
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>@lang('admin.end_date')</label>
                                  <input type="text" class="form-control" name="end_date" id="end_date" required>
                              </div>
                          </div>
                      </div>
                      <button class="btn btn-primary" type="submit">@lang('admin.generate_report')</button>
                  </form>
              </div>
          </div>
          <!-- end card -->
      </div> 
  </div>

  @if ($orders !=null)
  <div class="card">
    <div class="row">
    <div class="col-3">
      <span><strong><h5>@lang('admin.total_sale'): {{currency().number_format($total_pro_amount,2)}}</h5></strong></span>
    </div>
    <div class="col-3">
      <span><strong><h5>@lang('admin.total_order'): {{$total_orders}}</h5></strong></span>
    </div>
    <div class="col-3">
      <span><strong><h5>@lang('admin.total_sold_item'): {{$total_quantity}}</h5></strong></span>
    </div>
    <div class="col-3">
      <span><strong><h5>@lang('admin.seller_amount'): {{currency().number_format($total_earning,2)}}</h5></strong></span>
    </div>

    <div class="col-3">
      <span><strong><h5>@lang('admin.company_commission'): {{currency().number_format($total_company_will_get,2)}}</h5></strong></span>
    </div>
    </div>
  </div>
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   
                    <h4 class="mt-0 header-title"> Daily Report</h4>
                   <table id="datatable_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.order_number')</th>
                           <th>@lang('admin.sub_total')</th>
                           <th>@lang('admin.tax')</th>
                           <th>@lang('admin.shipping_charge')</th>
                           <th>@lang('admin.grand_total')</th>
                           <th>@lang('admin.quantity')</th>
                           <th>@lang('admin.payment')</th>
                           <th>@lang('admin.order_at')</th>
                           <th>@lang('admin.status')</th>
                          
                       </tr>
                       </thead>
                       <tbody>
                        @foreach ($orders as $order)
                        
                         <tr>
                           <td>{{$loop->index+1}}</td>
                           <td>#{{$order->order_number}}</td>
                           <td>{{currency().number_format($order->sub_total,2)}}</td>
                           <td>{{currency().number_format($order->tax,2)}}</td>
                           <td>{{currency().number_format($order->shipping_charge,2)}}</td>
                           <td>{{currency().number_format($order->grand_total,2)}}</td>
                           <td>{{$order->quantity}}</td>
                           <td>{{$order->payment_method}}</td>
                           <td>{{date('d-m-Y', strtotime($order->created_at))}}</td>
                           <td>{{$order->status}}</td>

                         </tr>

                      @endforeach
                      
                       </tbody>
                       
                   </table>
   
               </div>
           </div>
       </div> 
   </div> 
     @endif
@endsection
@section('js')
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
