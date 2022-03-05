@extends("layouts.admin")
@section("title","DPG Admin | Order Invoice")
@section("breadcrumb","Order Invoice")
@section("content")

<div class="page-title-box">
    <div class="row align-items-center">
       
        <div class="col-12">
            <div class="float-right d-none d-md-block">
                <div class="dropdown">
                    <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
                         <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>Back</a>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
</div>
<!-- end page-title -->

<div class="row">
    <div class="col-12">
      <div>
         <div class="card invoice_area">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="mt-0 float-right font-16"><strong>Order # {{$order->order_number}}</strong></h4>
                            <div class="mb-4">
                                <img src="{{ asset('assets/backend/image/logo/'.logo()) }}" alt="logo" height="16"/>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <address>
                                    <strong>Company Detail:</strong><br>
                                   <span>Name: </span><span>DPG-E-Marketplace</span><br>
                                    114 Kazi Nazrul Avenue<br>
                                    Bangla Motor. Dhaka<br>
                                    1200
                                </address>
                            </div>
                            <div class="col-6 text-right">
                              @php
                                $billing=json_decode($order->shipping_detail);

                              @endphp
                                <address>
                                    <strong>Shipped To:</strong><br>
                                    <span>Name</span> <span>{{$billing->fname}}</span><br>
                                    <span>Email</span> <span>{{$billing->lname}}</span><br>
                                    <span>Phone</span> <span>{{$billing->phone}}</span><br>
                                    <span>Country</span> <span>{{$billing->country}}</span><br>
                                    <span>City</span> <span>{{$billing->city}}</span><br>
                                    <span>Postcode</span> <span>{{$billing->postcode}}</span><br>
                                   <span>Address</span> <span>{{$billing->address}}</span><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-6 m-t-30">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{date("F d, Y", strtotime($order->created_at))}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-16"><strong>Order summary</strong></h3>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Product Name</strong></td>
                                            <td class="text-center"><strong>Image</strong></td>
                                            <td class="text-center"><strong>Price</strong>
                                            </td>
                                            <td class="text-right"><strong>Quantity</strong></td>
                                             <td class="text-right"><strong>Size</strong></td>
                                            <td class="text-right"><strong>Color</strong></td>
                                            <td class="text-right"><strong>Total</strong></td>

                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach ($order->items as $order_detail)
                                        <tr>
                                            <td>{{$order_detail->product->name}}</td>
                                            <td class="text-center"><img src="{{ asset('assets/backend/image/product/small/'.$order_detail->product->thumbnail) }}" style="width: 80px;height: 50px"></td>
                                            <td class="text-center">{{currency()}} {{$order_detail->product->current_price}}</td>
                                            <td class="text-right">{{$order_detail->product_quantity}}</td>
                                            <td class="text-right">{{$order_detail->size->size_code}}</td>
                                            <td class="text-right">{{$order_detail->color->color_name}} <span style="background-color: {{$order_detail->color->color_code}}; color:{{$order_detail->color->color_code}}">color</span></td>
                                            <td class="text-right">{{currency()}} {{$order_detail->product->current_price*$order_detail->product_quantity}}</td>

                                        </tr>

                                        @endforeach
                                       
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center">
                                                <strong>Subtotal</strong></td>
                                            <td class="thick-line text-right">{{currency()}} {{$order->sub_total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Shipping</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{shipping_charge()}}</td>
                                        </tr>
                                         <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                           <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Tax</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{tax()}}</td>
                                        </tr>

                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center">
                                                <strong>Grand Total</strong></td>
                                            <td class="no-line text-right">{{currency()}} {{$order->sub_total}}</td>
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
      </div>

      <div class="d-print-none">
          <div class="float-right">
              <a href="javascript:;" class="btn btn-success waves-effect waves-light print_invoice"><i class="fa fa-print"></i></a>
          </div>
      </div>
    </div> <!-- end col -->
</div>  
@endsection

@section('js')
  <script src="{{ asset('assets/backend/style/js/print.js') }}"></script>
 <script type="text/javascript"> 
     $(document).ready(function(){
          ////===========making printer ================
       $(".print_invoice").click(function(){
             var mode = 'iframe';
             var close = mode == "popup";
             var options = { mode : mode, popClose : close};
             $(".invoice_area").printArea( options );
       });
     });
 </script>
@endsection()
