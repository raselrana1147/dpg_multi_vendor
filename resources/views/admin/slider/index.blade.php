@extends("layouts.admin")
@section("title","DPG Admin | Slider List")
@section("breadcrumb",trans('admin.slider_list'))
@section("content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                     <a href="{{ route('admin.slider_create') }}" class="btn btn-primary btn-icon float-right"><span class="btn-icon-label"><i class="fas fa-plus mr-2"></i></span>@lang('admin.add_new')</a>
                    <h4 class="mt-0 header-title">@lang('admin.slider_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('admin.serial')</th>
                           <th>@lang('admin.title_1')</th>
                           <th>@lang('admin.title_2')</th>
                           <th>@lang('admin.price')</th>
                           <th>@lang('admin.button_title')</th>
                           <th>@lang('admin.link')</th>
                           <th>@lang('admin.image')</th>
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
             ajax: '{{ route('admin.load_slider') }}',
             columns: [
                 { data: 'id',name:'id' },
                 { data: 'title_1',name:'title_1'},
                 { data: 'title_2',name:'title_2'},
                 { data: 'price',name:'price'},
                 { data: 'button_title',name:'button_title'},
                 { data: 'url',name:'url'},
                 { data: 'image',name:'image'},
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