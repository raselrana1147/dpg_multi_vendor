@extends("layouts.seller")
@section("title","DPG Seller | Product Create")
@section('seller_css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  {{-- <link href="{{ asset('assets/style/css/summernote.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('assets/backend/style/plugin/css/select2.min.css') }}" rel="stylesheet" />

@endsection
@section("seller_breadcrumb",trans('seller.product_create'))
@section("seller_content")
      <div class="message_section" style="display: none"></div>
    <form id="submit_form" class="custom-validation" data-action="{{ route('seller.product_store') }}" enctype="multipart/form-data" method="POST">
          @csrf
      <div class="row">
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label>@lang('seller.category')</label><span class="pl-1 text-danger">*</span>
                            <div>
                               <select class="form-control" name="category_id" id="find_sub_category" required="" data-action="{{ route('find_sub_category') }}">
                                 <option value="">@lang('seller.select_category')</option>
                                 @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                 @endforeach
                               </select>
                            </div>
                        </div>

                         <div class="form-group">
                             <label>@lang('seller.sub_category')</label>
                             <i data-toggle="tooltip" data-placement="top" 
                             data-original-title="@lang('seller.sub_cat_tooptip')" 
                             class="mdi mdi-information"></i>
                             <div>
                                <select class="form-control load_sub_cat" name="sub_category_id">
                                </select>
                             </div>
                         </div>
                          <div class="form-group">
                              <label>@lang('seller.name_or_title')</label><span class="pl-1 text-danger">*</span>
                              <input type="text" class="form-control" name="name" required placeholder="@lang('seller.enter_name_or_title')"/>
                          </div>
    
                          <div class="form-group">
                              <label>@lang('seller.product_type')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                 <select class="form-control" name="product_type_id" required="">
                                  <option value="">@lang('seller.selet_type')</option>
                                  @foreach ($producttypes as $type)
                                    <option value="{{$type->id}}">{{$type->type_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label>@lang('seller.measurement_unit')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                 <select class="form-control" name="measurement_id">
                                    <option value="">Piece</option>
                                    <option value="">KG</option>
                                    <option value="">Liter</option>
                                    <option value="">Meter</option>
                                 </select>
                              </div>
                          </div>

                          <div class="form-group">
                             <label>@lang('seller.brand')</label><span class="pl-1 text-danger">*</span>
                             <div>
                                <select class="form-control" name="brand_id" required="">
                                  <option value="">@lang('seller.select_brand')</option>
                                  @foreach ($brands as $brand)
                                     <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                  @endforeach
                                 
                                </select>
                             </div>
                         </div>

                          <div class="form-group">
                              <label>@lang('seller.purchase_price')</label><span class="pl-1 text-mute">(Optional)</span>
                              <div>
                                  <input type="number" class="form-control" name="purchase_price" placeholder="@lang('seller.enter_price')" min="0" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label>@lang('seller.previous_price')</label><span class="pl-1 text-mute">(Optional)</span>
                              <div>
                                  <input type="number" class="form-control" name="previous_price" placeholder="@lang('seller.enter_price')" min="0" />
                              </div>
                          </div>
                           <div class="form-group">
                              <label>@lang('seller.current_sale_price')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                  <input type="number" class="form-control" name="current_price" required placeholder="@lang('seller.enter_price')" min="0" />
                              </div>
                          </div>

                           <div class="form-group">
                              <label>@lang('seller.sale_type')</label><span class="pl-1 text-danger">*</span><i data-toggle="tooltip" data-placement="top" 
                              data-original-title="@lang('seller.sale_type_tooltip')" 
                              class="mdi mdi-information"></i>
                              <div>
                                  
                                  <div class="custom-control custom-radio mb-2">
                                      <input type="radio" id="sale_type_retail" name="sale_type" class="custom-control-input" checked value="retail" >
                                      <label class="custom-control-label" for="sale_type_retail" >Retail</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                      <input type="radio" id="sale_type_whole" name="sale_type" class="custom-control-input" value="whole">
                                      <label class="custom-control-label" for="sale_type_whole">Whole Sale</label>
                                  </div>
                              </div> 
                          </div>

                          <div class="form-group show_whole_section"  style="display: none">
                              <label>Whole Sale quantity</label><span class="pl-1 text-danger">*</span>
                              <i data-toggle="tooltip" data-placement="top" 
                              data-original-title="@lang('seller.whole_sale_tooltip')" 
                              class="mdi mdi-information"></i>
                              <div>
                                  <input type="number" class="form-control" id="whole_sale_quantity" name="whole_sale_quantity" min="1" />
                              </div>
                          </div>

                          <div class="form-group">
                              <label>@lang('seller.tag')</label><span class="pl-1 text-danger">*</span><i data-toggle="tooltip" data-placement="top" 
                              data-original-title="@lang('seller.tag_tooltip')" 
                              class="mdi mdi-information"></i>
                              <select class="form-control add_tag" name="tags[]" multiple="multiple" required>
                                
                              </select>
                          </div>
                            <div class="form-group mb-0">
                              <div>
                                  <button type="submit" class="submit_button btn btn-primary waves-effect waves-light mr-1">
                                      @lang('seller.submit')
                                  </button>
                                  <button type="reset" class="btn btn-secondary waves-effect">
                                      @lang('seller.cancel')
                                  </button>
                              </div>
                          </div>
                  </div>
              </div>
          </div> <!-- end col -->
      
          <div class="col-lg-6">
              <div class="card">
                  <div class="card-body">

                        <div class="form-group">
                            <label>@lang('seller.video_link')</label> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('seller.video_link_tooltip')" class="mdi mdi-information"></i>
                            <div>
                                <input type="url" class="form-control" name="video_link" placeholder="http://www.example.com" />
                            </div>
                        </div>

                          <div class="form-group">
                              <label>@lang('seller.thumbnail')</label> <span class="pl-1 text-danger">*</span> 
                              <i data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('seller.thumbnail_tooltip')" class="mdi mdi-information"></i>
                              <div>
                                  <input type="file" class="form-control dropify" name="thumbnail" required/>
                              </div>
                          </div>

                          <div class="custom-control custom-checkbox mb-2">
                              <input type="checkbox" id="will_seo" name="will_seo" class="custom-control-input" value="will_seo" >
                              <label class="custom-control-label" for="will_seo" >@lang('seller.seo_info')</label>
                              <i data-toggle="tooltip" data-placement="top" 
                                data-original-title="@lang('seller.seo_tooltip')" 
                              class="mdi mdi-information"></i>
                          </div>
                          <div class="form-group show_seo_section ml-4" style="display:none">
                              <label>@lang('seller.meta_title')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                  <input type="text" class="form-control" id="meta_title" name="meta_title"/>
                              </div>

                              <label>@lang('seller.meta_keyword')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                  <select class="form-control add_tag" multiple="multiple" id="meta_keyword" name="meta_keywords[]">
                                  </select>
                              </div>

                              <label>@lang('seller.meta_description')</label><span class="pl-1 text-danger">*</span>
                              <div>
                                   <textarea class="form-control summernote" id="meta_description" name="meta_description"></textarea>
                              </div>
                          </div>

                        
                          <div class="form-group">
                              <label>@lang('seller.detail')</label><i data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('seller.description_tooltip')" class="mdi mdi-information"></i>
                              <div>
                                  <textarea class="form-control summernote" name="description"></textarea>
                              </div>
                          </div>
                           <div class="form-group">
                              <label>@lang('seller.specification')</label> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('seller.specification_tooltip')" class="mdi mdi-information"></i>
                              <div>
                                  <textarea class="form-control summernote" name="specification"></textarea>
                              </div>
                          </div>

                           <div class="form-group">
                              <label>@lang('seller.return_policy')</label> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('seller.return_policy_tooltip')" class="mdi mdi-information"></i>
                              <div>
                                  <textarea class="form-control summernote" name="return_policy"></textarea>
                              </div>
                          </div>
                  </div>
              </div>
          </div> <!-- end col -->
      </div> <!-- end row -->
      </form>

@endsection

@section('seller_js')

<script src="{{ asset('assets/style/js/summernote.js') }}"></script>
<script src="{{ asset('assets/backend/style/plugin/js/select2.min.js') }}"></script>

  <script>
    $(document).ready(function(){
        $('.summernote').summernote();
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
                        if (data.status_code==201) 
                        {
                          $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                           </button>
                          </div>`).show();
                           $(".submit_button").text("Submit").prop('disabled', false)
                        }else{
                             $("#submit_form")[0].reset();
                             $(".submit_button").text("Submit").prop('disabled', false)
                             $('.message_section').html('').hide();
                              toastr.success(data.message);
                         }
                    },

                    error:function(response){
                        
                    }

                  });
            });

            //===select2=====
        $(".add_tag").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
        $(".add_meta_keyword").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    })
</script>

@endsection