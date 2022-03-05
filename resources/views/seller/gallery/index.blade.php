@extends("layouts.seller")
@section("seller_title","DPG Seller| Gallery List")
@section("seller_breadcrumb",trans('seller.gallery'))
@section("seller_content")
   <div class="row">
       <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                   <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
                       <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('seller.back')</a>
                        <form id="submit_form" class="custom-validation" data-action="{{ route('seller.gallery_store') }}" enctype="multipart/form-data" method="POST">
                         @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="form-group">
                                <label>@lang('seller.gallery_image')</label>
                                <div>
                                    <input type="file" name="image" class="form-control dropify" required="" data-default-file="{{($product->thumbnail !=null) ?  asset('assets/backend/image/product/small/'.$product->thumbnail) : asset('assets/backend/image/default.png') }}"/>
                                </div>
                                
                            </div>
                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 submit_button">
                                        @lang('seller.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
        
                    </div>
                </div>
           <div class="card">
               <div class="card-body">
                    <h4 class="mt-0 header-title">@lang('seller.gallery_image_list')</h4>
                   <table id="tables_item" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                       <thead>
                       <tr>
                           <th width="5">S.</th>
                           <th width="55">@lang('seller.prodcut_name')</th>
                           <th width="20">@lang('seller.gallery_image')</th>
                           <th width="20">@lang('seller.action')</th>
                       </tr>
                       </thead>
                       <tbody>
                        @foreach ($galleries as $gallery)
                         <tr class="hide_row{{$gallery->id}}">
                           <td>{{$loop->index+1}}</td>
                           <td>{{$gallery->product->name}}</td>
                           <td><img src="{{ asset('assets/backend/image/gallery/medium/'.$gallery->image) }}" border="0" width="300" height="90" class="img-rounded" /></td>
                           <td>
                             <a href="{{ route('seller.gallery_edit',$gallery->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                               <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="{{ route('seller.gallery_delete') }}"  item_id="{{$gallery->id}}">
                               <i class="fa fa-trash"></i>
                              </a>
                           </td>
                         </tr>

                          @endforeach
                       </tbody>
                      
                   </table>
   
               </div>
           </div>
       </div> <!-- end col -->
   </div> <!-- end row -->
@endsection
@section('seller_js')

    <script>
        $(document).ready(function(){


              $('body').on('submit','#submit_form',function(e){
                        e.preventDefault();
                        let formDta = new FormData(this);
                     $(".submit_button").html("Processing...").prop('disabled', true)
                  
                        $.ajax({
                          url: $(this).attr('data-action'),
                          method: "POST",
                          data: formDta,
                          cache: false,
                          contentType: false,
                          processData: false,
                          success:function(data){
                               toastr.success(data.message);
                              $("#submit_form")[0].reset();
                              $(".submit_button").text("Submit").prop('disabled', false)
                              $('.message_section').html('').hide();
                              location.reload();
                          },

                          error:function(response){}

                        });
                  });
              
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
                              location.reload(); 
                          }

                       }); 
                
                  } 
                });
              })  
        })
    </script>
@endsection()
