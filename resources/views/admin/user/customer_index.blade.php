@extends("layouts.admin")
@section("title","DPG Admin | Customer List")
@section("breadcrumb",trans('admin.customer_list'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                     
                    <h4 class="mt-0 header-title">@lang('admin.customer_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.first_name')</th>
                           <th>@lang('admin.last_name')</th>
                           <th>@lang('admin.image')</th>
                           <th>@lang('admin.joining_date')</th>
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
             ajax: '{{ route('admin.load_customer') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'first_name',name:'first_name'},
                 { data: 'last_name',name:'last_name'},
                 { data: 'image',name:'image'},
                 { data: 'joining',name:'joining'},
                 { data: 'action',name:'action' },
             ],
              language : {
                   processing: '@lang('admin.processing')'
               },  
         });
    </script>
    <script>
        $(document).ready(function(){
              
              $('body').on('click','.delete_item',function(){
                let item_id=$(this).attr('item_id');
                swal({
                  title: "Do you want to delete?",
                  icon: "info",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       $.ajax({
                          url:$(this).attr('data-action'),
                          method:'post',
                          data:{item_id:item_id},
                          success:function(data){
                             toastr.success(data.message);
                             $('#tables_item').DataTable().ajax.reload();
                             
                          }

                       }); 
                
                  } 
                });
              })

            
        })
    </script>
@endsection()