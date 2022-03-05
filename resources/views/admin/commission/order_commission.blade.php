@extends("layouts.admin")
@section("title","DPG Admin | Order Commission")
@section("breadcrumb",trans('admin.order_commission'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   
                    <h4 class="mt-0 header-title">@lang('admin.order_commission_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.order_number')</th>
                           <th>@lang('admin.total_amount')</th>
                           <th>@lang('admin.seller_get')</th>
                           <th>@lang('admin.company_get')</th>
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
             ajax: '{{ route('admin.load_order_commission') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'order_number',name:'order_number'},
                 { data: 'sub_total',name:'sub_total'},
                 { data: 'seller_amount',name:'seller_amount'},
                 { data: 'company_will_get',name:'company_will_get'},
                 
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