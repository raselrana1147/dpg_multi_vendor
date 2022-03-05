@extends("layouts.admin")
@section("title","DPG Admin | Order List")
@section("breadcrumb",trans('admin.order_list'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   
                    <h4 class="mt-0 header-title">@lang('admin.order_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>
                    <h4 class="mt-0 header-title">@lang('admin.serial')</th>
                           <th>@lang('admin.order_number')</th>
                           <th>@lang('admin.sub_total')</th>
                           <th>@lang('admin.tax')</th>
                           <th>@lang('admin.shipping_charge')</th>
                           <th>@lang('admin.grand_total')</th>
                           <th>@lang('admin.quantity')</th>
                           <th>@lang('admin.payment')</th>
                           <th>@lang('admin.order_at')</th>
                           <th>@lang('admin.status')</th>
                           <th>@lang('admin.action')</th>
                       </tr>
                       </thead>
                      
                   </table>
   
               </div>
           </div>
       </div> <!-- end col -->
   </div> <!-- end row -->
@endsection
@section('js')

 <script>
         var table = $("#tables_item").DataTable({
             processing: true,
             responsive: true,
             serverSide: true,
             ordering: false,
             pagingType: "full_numbers",
             ajax: '{{ route('admin.load_order') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'order_number',name:'order_number'},
                 { data: 'sub_total',name:'sub_total'},
                 { data: 'tax',name:'tax'},
                 { data: 'shipping_charge',name:'shipping_charge'},
                 { data: 'grand_total',name:'grand_total'},
                 { data: 'quantity',name:'quantity'},
                 { data: 'payment_method',name:'payment_method'},
                 { data: 'created_at',name:'created_at'},
                 { data: 'status',name:'status'},
                 { data: 'action',name:'action' },
             ],

              language : {
                   processing: '@lang('admin.processing')'
               },
              
         });
    </script>

   <script>
       $(document).ready(function(){
             
             $('body').on('change','.update_order_status',function(){
                
               let order_id=$(this).attr('order_id');
               let status=$(this).val();
                  $.ajax({
                     url:$(this).attr('data-action'),
                     method:'post',
                     data:{order_id:order_id,status:status},
                     success:function(data){
                        toastr.success(data.message);
                     }

                  }); 
             })   
       })
   </script>
@endsection()