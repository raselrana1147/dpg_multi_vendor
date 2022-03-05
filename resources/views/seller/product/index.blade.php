@extends("layouts.seller")
@section("seller_title","DPG Seller| Product List")
@section("seller_breadcrumb",trans('seller.add_new'))

@section("seller_content")
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-body">
                     <a href="{{ route('seller.product_create') }}" class="btn btn-primary btn-icon float-right">
                      <span class="btn-icon-label"><i class="fas fa-plus mr-2"></i></span>@lang('seller.add_new')</a>
                    <h4 class="mt-0 header-title">@lang('seller.product_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" 
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th>@lang('seller.serial')</th>
                           <th>@lang('seller.prodcut_name')</th>
                           <th>@lang('seller.image')</th>
                           <th>@lang('admin.total_order')</th>
                           <th>@lang('admin.last_order_date')</th>
                           <th>@lang('admin.total_view')</th>
                           <th>@lang('seller.attribute')</th>
                           <th>@lang('seller.action')</th>
                       </tr>
                       </thead>
                      
                   </table>
   
               </div>
           </div>
       </div> <!-- end col -->
   </div> <!-- end row -->
   <div id="product-status" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalProduct" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title mt-0" id="myModalProduct">Product Status</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
                <div class="product-status">
                 
                    <input type="hidden" class="store_product_id" name="store_product_id" value="" data-action="{{ route('seller.update_product_status') }}">
                  <div>
                      <input type="checkbox" id="flash_deal" switch="dark" class="change_product_status" status_type="flash_deal"/>
                      <label for="flash_deal" data-on-label="Yes" data-off-label="No"></label><span>Flash Deal</span>
                  </div>

                  <div>
                      <input type="checkbox" id="featured" switch="dark" class="change_product_status" status_type="featured"/>
                      <label for="featured" data-on-label="Yes" data-off-label="No"></label><span>Featured</span>
                  </div>

                  <div>
                      <input type="checkbox" id="best_sale" switch="dark" class="change_product_status" status_type="best_sale"/>
                      <label for="best_sale" data-on-label="Yes" data-off-label="No"></label><span>Best Sale</span>
                  </div>


                   <div>
                      <input type="checkbox" id="hot" switch="dark" class="change_product_status" status_type="hot"/>
                      <label for="hot" data-on-label="Yes" data-off-label="No"></label><span>Hot</span>
                  </div>

                  <div>
                      <input type="checkbox" id="top_sale" switch="dark" class="change_product_status" status_type="top_sale"/>
                      <label for="top_sale" data-on-label="Yes" data-off-label="No"></label><span>Top Sale</span>
                  </div>

                   <div>
                      <input type="checkbox" id="big_save" switch="dark" class="change_product_status" status_type="big_save"/>
                      <label for="big_save" data-on-label="Yes" data-off-label="No"></label><span>Big Save</span>
                  </div>

                   <div>
                      <input type="checkbox" id="new_arrival" switch="dark" class="change_product_status" status_type="new_arrival"/>
                      <label for="new_arrival" data-on-label="Yes" data-off-label="No"></label><span>New Arrival</span>
                  </div>

                  <div>
                      <input type="checkbox" id="trending" switch="dark" class="change_product_status" status_type="trending"/>
                      <label for="trending" data-on-label="Yes" data-off-label="No"></label><span>Treanding</span>
                  </div>
                  

                 </div>
           </div>
       </div>
   </div>
    </div>
@endsection
@section('seller_js')

<script>
        var table = $("#tables_item").DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: false,
            pagingType: "full_numbers",
            ajax: '{{ route('seller.load_product') }}',
            columns: [
                { data: 'id',name:'id' },
                { data: 'name',name:'name'},
                { data: 'thumbnail',name:'thumbnail'},
                { data: 'total_order',name:'total_order'},
                { data: 'last_ordered_at',name:'last_ordered_at'},
                { data: 'view',name:'view'},
                { data: 'attribute',name:'attribute'},
                { data: 'action',name:'action' },
            ],

             language : {
                  processing: '@lang('seller.processing')'
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
