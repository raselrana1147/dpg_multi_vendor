@extends("layouts.admin")
@section("title","DPG Admin | Product List")
@section("breadcrumb",trans('admin.product_list'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                    <h4 class="mt-0 header-title">@lang('admin.product_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.prodcut_name')</th>
                           <th>@lang('admin.thumbnail')</th>
                           <th>@lang('admin.total_order')</th>
                           <th>@lang('admin.last_order_date')</th>
                           <th>@lang('admin.total_view')</th>
                           <th>@lang('admin.product_owner_info')</th>
                           <th>@lang('admin.price')</th>
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
             ajax: '{{ route('admin.load_product') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'name',name:'name'},
                 { data: 'thumbnail',name:'thumbnail'},
                 { data: 'total_order',name:'total_order'},
                 { data: 'last_ordered_at',name:'last_ordered_at'},
                 { data: 'view',name:'view'},
                 { data: 'owner',name:'owner'},
                 { data: 'current_price',name:'current_price'},
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