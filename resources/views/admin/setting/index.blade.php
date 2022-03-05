@extends("layouts.admin")
@section("title","DPG Admin | General Setting")
@section("breadcrumb",trans('admin.general_setting'))
@section("content")

    <div class="message_section" style="display: none"></div>
   <div class="row">

       <div class="col-lg-8 offset-2">
           <div class="card">
               <div class="card-body">
             <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
                 <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('admin.back')</a>
                   <form id="submit_form" class="custom-validation" data-action="{{ route('admin.update.general_setting') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                       <input type="hidden" name="id" value="{{$general_setting->id}}">
                       <div class="form-group">
                           <label>@lang('admin.site_name')</label>
                           <input type="text" class="form-control" name="site_name" required value="{{$general_setting->site_name}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.site_title')</label>
                           <input type="text" class="form-control" name="title" required value="{{$general_setting->title}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.copyright')</label>
                           <input type="text" class="form-control" name="copyright" required value="{{$general_setting->copyright}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.currency')</label>
                           <input type="text" class="form-control" name="currency" required value="{{$general_setting->currency}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.company_address')</label>
                           <input type="text" class="form-control" name="company_address" required value="{{$general_setting->company_address}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.site_description')</label>
                           <input type="text" class="form-control" name="description" required value="{{$general_setting->description}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.company_phone')</label>
                           <input type="text" class="form-control" name="company_phone" required value="{{$general_setting->company_phone}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.company_email')</label>
                           <input type="text" class="form-control" name="company_email" required value="{{$general_setting->company_email}}" />
                       </div>

          
                       <div class="form-group">
                           <label>@lang('admin.facebook')</label>
                           <input type="text" class="form-control" name="facebook" required value="{{$general_setting->facebook}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.instragram')</label>
                           <input type="text" class="form-control" name="instrgram" required value="{{$general_setting->instrgram}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.youtube')</label>
                           <input type="text" class="form-control" name="youtube" required value="{{$general_setting->youtube}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.twitter')</label>
                           <input type="text" class="form-control" name="twitter" required value="{{$general_setting->twitter}}" />
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.linkedin')</label>
                           <input type="text" class="form-control" name="linkedin" required value="{{$general_setting->linkedin}}" />
                       </div>

   
                       <div class="form-group">
                           <label>@lang('admin.logo')</label>
                           <div>
                               <input type="file" name="logo" class="form-control dropify" data-default-file="{{($general_setting->logo !=null) ?  asset('assets/backend/image/logo/'.$general_setting->logo) : asset('assets/backend/image/logo/'.default_image()) }}"/>
                           </div>
                           
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.favicon')</label>
                           <div>
                               <input type="file" name="favicon" class="form-control dropify" data-default-file="{{($general_setting->favicon !=null) ?  asset('assets/backend/image/logo/'.$general_setting->favicon) : asset('assets/backend/image/'.default_image()) }}"/>
                           </div>
                           
                       </div>

                       <div class="form-group">
                           <label>@lang('admin.default_image')</label>
                           <div>
                               <input type="file" name="default_image" class="form-control dropify" data-default-file="{{($general_setting->default_image !=null) ?  asset('assets/backend/image/'.$general_setting->default_image) : asset('assets/backend/image/'.default_image()) }}"/>
                           </div>
                           
                       </div>
                       <div class="form-group">
                           <label>@lang('admin.loader')</label>
                           <div>
                               <input type="file" name="loader" class="form-control dropify" data-default-file="{{($general_setting->loader !=null) ?  asset('assets/backend/image/logo/'.$general_setting->loader) : asset('assets/backend/image/'.default_image()) }}"/>
                           </div>
                           
                       </div>

                        <div class="form-group">
                           <label>@lang('admin.slider_background')</label>
                           <div>
                               <input type="file" name="slider_background" class="form-control dropify" data-default-file="{{($general_setting->slider_background !=null) ?  asset('assets/backend/image/logo/'.$general_setting->slider_background) : asset('assets/backend/image/'.default_image()) }}"/>
                           </div>
                           
                       </div>
                       <div class="form-group mb-0">
                           <div>
                               <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 submit_button">
                                   @lang('admin.submit')
                               </button>
                           </div>
                       </div>
                   </form>
   
               </div>
           </div>

   </div> <!-- end row -->
</div>
@endsection
@section('js')

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
                        $(".submit_button").text("Submit").prop('disabled', false)
                        $('.message_section').html('').hide();
                    },

                    error:function(response){
                    }

                  });
            });

    })
</script>

@endsection