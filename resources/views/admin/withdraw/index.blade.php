@extends("layouts.admin")
@section("title","DPG Admin | Withdraw Request")
@section("breadcrumb",trans('admin.withdrawal_request'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                   
                    <h4 class="mt-0 header-title">@lang('admin.withdrawal_request')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>Seller</th>
                           <th>@lang('admin.withdrawal_amount')</th>
                           <th>@lang('admin.account_number')</th>
                           <th>@lang('admin.branch_name')</th>
                           <th>@lang('admin.branch_name')</th>
                           <th>@lang('admin.withdrawal_at')</th>
                           <th>@lang('admin.action')</th>
                           <th>@lang('admin.comment')</th>
                           <th>@lang('admin.note')</th>
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
             ajax: '{{ route('admin.load_withdraw_request') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'seller',name:'seller' },
                 { data: 'withdraw_amount',name:'withdraw_amount'},
                 { data: 'account_number',name:'account_number'},
                 { data: 'bank_name',name:'bank_name'},
                 { data: 'branch_name',name:'branch_name'}, 
                 { data: 'created_at',name:'created_at'},
                 { data: 'action',name:'action'},
                 { data: 'comment',name:'comment'}, 
                 { data: 'note',name:'note'}, 
             ],

              language : {
                   processing: '@lang('admin.processing')'
               },
              
         });
    </script>

   <script>
       $(document).ready(function(){
             
             $('body').on('change','.update_withdraw_status',function(){
               let withdraw_id=$(this).attr('withdraw_id');
               let status=$(this).val();
                  $.ajax({
                     url:$(this).attr('data-action'),
                     method:'post',
                     data:{withdraw_id:withdraw_id,status:status},
                     success:function(data){
                        toastr.success(data.message);
                     }

                  }); 
             })   
       })
   </script>
@endsection()