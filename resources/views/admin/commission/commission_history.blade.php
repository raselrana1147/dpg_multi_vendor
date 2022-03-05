@extends("layouts.admin")
@section("title","DPG Admin | Order Commmission History")
@section("breadcrumb",trans('admin.admin.order_commission_history_list'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   
                    <h4 class="mt-0 header-title">@lang('admin.order_commission_history_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.order_number')</th>
                           <th>@lang('admin.quantity')</th>
                           <th>@lang('admin.prodcut_name')</th>
                           <th>@lang('admin.product_owner_info')</th>
                           <th>@lang('admin.unit_commission')</th>
                           <th>@lang('admin.total_commission')</th>
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
             ajax: '{{ route('admin.load_order_history') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'order_number',name:'order_number'},
                 { data: 'quantity',name:'quantity'},
                 { data: 'product',name:'product'},
                 { data: 'seller',name:'seller'},
                 { data: 'unit_commission',name:'unit_commission'},
                 { data: 'total_commission',name:'total_commission'},    
             ],

              language : {
                   processing: 'Processing'
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