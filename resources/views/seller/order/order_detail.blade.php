@extends("layouts.seller")
@section("seller_title","DPG Seller| Order details")
@section("seller_breadcrumb",trans('seller.order_detail'))
@section("seller_content")

  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                  <div class="row">
                      <div class="col-12">
                          <div>
                              <div class="p-2">
                                  <h3 class="font-16"><strong>@lang('seller.order_detail')</strong></h3>
                                  <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
                       <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('seller.back')</a>
                              </div>
                              <div class="">
                                  <div class="table-responsive">
                                      <table class="table">
                                          <thead>
                                          <tr>
                                              <td width="20%"><strong>@lang('seller.prodcut_name')</strong></td>
                                              <td width="30%" class="text-center"><strong>@lang('seller.image')</strong></td>
                                              <td width="10%" class="text-center"><strong>@lang('seller.price')</strong>
                                              </td>
                                              <td width="10%" class="text-right"><strong>@lang('seller.quantity')</strong></td>
                                               <td width="10%" class="text-right"><strong>@lang('seller.size')</strong></td>
                                              <td width="10%" class="text-right"><strong>@lang('seller.color')</strong></td>
                                              <td width="10%" class="text-right"><strong>@lang('seller.total')</strong></td>

                                          </tr>
                                          </thead>
                                          <tbody>
                                         @foreach ($order_details as $order_detail)
                                          <tr>
                                              <td>{{$order_detail->product->name}}</td>
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
                                              <td class="no-line"></td>
                                              <td class="no-line text-center">
                                                  <strong>@lang('seller.grand_total')</strong></td>
                                              <td class="no-line text-right">{{currency()}} {{number_format($grand_total),2}}</td>
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
@endsection

