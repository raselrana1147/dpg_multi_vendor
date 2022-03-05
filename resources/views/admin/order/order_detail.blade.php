@extends("layouts.admin")
@section("title","DPG Admin | Order Detail")
@section("breadcrumb",trans('admin.order_detail'))
@section("content")

<div class="row">

  <div class="col-md-6">

    <div class="card">

      <div class="card-header">
        <h6>@lang('admin.order_detail')</h6>
      </div>
      <div class="card-body">
        <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
             <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('admin.back')</a>
          <table class="my_table table" style="border:none">
            <tr>
              <th>@lang('admin.order_number'):</th>
              <td>{{$order->order_number}}</td>
            </tr>
            <tr>
              <th>@lang('admin.order_at'):</th>
              <td>{{date('Y-d-m H:m', strtotime($order->created_at))}}</td>
            </tr>

            <tr>
              <th>@lang('admin.sub_total'):</th>
              <td>{{currency()}}{{number_format($order->sub_total,)}}</td>
            </tr>

            <tr>
              <th>@lang('admin.tax'):</th>
              <td>{{currency()}}{{number_format(tax(),2)}}</td>
            </tr>
            <tr>
              <th>@lang('admin.shipping_charge'):</th>
              <td>{{currency()}}{{number_format(shipping_charge(),2)}}</td>
            </tr>
            <tr>
              <th>@lang('admin.grand_total'):</th>
              <td>{{currency()}}{{number_format($order->grand_total,2)}}</td>
            </tr>
            <tr>
              <th>@lang('admin.payment'):</th>
              <td>{{$order->payment_method}}</td>
            </tr>
            
            <tr>
              <th>@lang('admin.total_item'):</th>
              <td>{{$order->quantity}}</td>
            </tr>
            <tr>
              <th>@lang('admin.status'):</th>
              <td>{{$order->status}}</td>
            </tr>
            
          </table>
      </div>
    </div>
  </div>

  <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h6>@lang('admin.billing_detail')</h6>
        </div>
        <div class="card-body">
            <table class="my_table table" style="border:none">
              @php
                $billing=json_decode($order->shipping_detail);

              @endphp
              <tr>
                <th>@lang('admin.first_name')</th>
                <td>{{$billing->fname}}</td>
              </tr>

              <tr>
                <th>@lang('admin.last_name')</th>
                <td>{{$billing->lname}}</td>
              </tr>

              <tr>
                <th>@lang('admin.email')</th>
                <td>{{$billing->email}}</td>
              </tr>

              <tr>
                <th>@lang('admin.phone')</th>
                <td>{{$billing->phone}}</td>
              </tr>

              <tr>
                <th>@lang('admin.country')</th>
                <td>{{$billing->country}}</td>
              </tr>

              <tr>
                <th>@lang('admin.city')</th>
                <td>{{$billing->city}}</td>
              </tr>

              <tr>
                <th>@lang('admin.postcode')</th>
                <td>{{$billing->postcode}}</td>
              </tr>
              
              <tr>
                <th>@lang('admin.address')</th>
                <td>{{$billing->address}}</td>
              </tr>
            </table>
        </div>
      </div>
  </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-16"><strong>@lang('admin.order_summary')</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td width="20%"><strong>@lang('admin.prodcut_name')</strong></td>
                                            <td width="15%" class="text-center"><strong>@lang('admin.product_owner_info')</strong></td>
                                            <td width="15%" class="text-center"><strong>@lang('admin.image')</strong></td>
                                            <td width="10%" class="text-center"><strong>@lang('admin.price')</strong>
                                            </td>
                                            <td width="10%" class="text-right"><strong>@lang('admin.quantity')</strong></td>
                                             <td width="10%" class="text-right"><strong>@lang('admin.size')</strong></td>
                                            <td width="10%" class="text-right"><strong>@lang('admin.color')</strong></td>
                                            <td width="10%" class="text-right"><strong>@lang('admin.total')</strong></td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach ($order->items as $order_detail)
                                        <tr>
                                            <td>{{$order_detail->product->name}}</td>
                                            <td>{{$order_detail->seller->full_name}}</td>
                                            <td class="text-center"><img src="{{ asset('assets/backend/image/product/small/'.$order_detail->product->thumbnail) }}" style="width: 80px;height: 50px"></td>
                                            <td class="text-center">{{currency()}} {{number_format($order_detail->product->current_price,2)}}</td>
                                            <td class="text-right">{{$order_detail->product_quantity}}</td>
                                            <td class="text-right">{{$order_detail->size->size}}</td>
                                            <td class="text-right">{{$order_detail->color->color_name}} <span style="background: {{$order_detail->color->color_code}}; color:{{$order_detail->color->color_code}}">color</span></td>
                                            <td class="text-right">{{currency()}} {{number_format($order_detail->product->current_price*$order_detail->product_quantity),2}}</td>

                                        </tr>

                                        @endforeach
                                       
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center">
                                                <strong>@lang('admin.sub_total')</strong></td>
                                            <td class="thick-line text-right">{{currency()}} {{number_format($order->sub_total,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>@lang('admin.shipping_charge')</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{number_format(shipping_charge(),2)}}</td>
                                        </tr>
                                         <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                           <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>@lang('admin.tax')</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{number_format(tax(),2)}}</td>
                                        </tr>

                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>@lang('admin.grand_total')</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{number_format($order->grand_total),2}}</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                
                              
                            </div>
                        </div>
                
                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
   
       
@endsection
