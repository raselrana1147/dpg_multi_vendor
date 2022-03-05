@extends("layouts.admin")
@section("title","DPG Admin | Profile Update")
@section("breadcrumb",trans('admin.update_profile'))
@section("content")
    <div class="message_section" style="display: none"></div>
   <div class="row pb-4">
    <div class="offset-5">
       <div class="text-center">
          <img id="profile_image_path" src="{{Auth::user()->profile_image_url !=null ? asset('assets/backend/image/profile/small/'.Auth::user()->profile_image_url) : asset('assets/backend/image/'.default_image())}}"  class="profile_image" alt="customer image"><br>
       
          <button type="button" class="btn btn-primary btn-icon upload_button">
              <span class="btn-icon-label"><i class="fas fa-upload"></i></span> @lang('title.upload')
          </button>

       </div>

    </div>
   </div>

   <div class="row">
     <div class="col-8 offset-2">
       <div class="card">
           <div class="card-body">
       
               <form id="submit_form" class="custom-validation" data-action="{{ route('admin.profile_update') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                   <input type="hidden" name="id" value="{{$admin->id}}">
                   
                   <input type="file" id="image_path" name="profile_image_url" class="d-none get_image">

                   <div class="form-group">
                       <label>@lang('admin.first_name')</label>
                       <input type="text" class="form-control" name="first_name" required placeholder="@lang('seller.enter_first_name')" value="{{$admin->first_name}}" />
                   </div>

                   <div class="form-group">
                       <label>@lang('seller.last_name')</label>
                       <input type="text" class="form-control" name="last_name" required value="{{$admin->last_name}}" placeholder="@lang('admin.enter_last_name')"/>
                   </div>
                   <div class="form-group">
                       <label>@lang('seller.phone')</label>
                       <input type="text" class="form-control" name="phone" value="{{$admin->phone}}" required placeholder="@lang('admin.enter_phone')"/>
                   </div>

                   <div class="form-group">
                      <div class="js-form-message mb-4">
                          <label class="form-label">
                              @lang('title.gender')
                              <span class="text-danger">*</span>
                          </label><br>

                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radioMale" name="gender" class="custom-control-input" {{$admin->gender=="Male" ? 'checked' : ''}} value="Male">
                            <label class="custom-control-label" for="radioMale">@lang('title.male')</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radioFemale" name="gender" class="custom-control-input" {{$admin->gender=="Female" ? 'checked' : ''}} value="Female">
                            <label class="custom-control-label" for="radioFemale">@lang('title.female')</label>
                          </div>

                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radionOther" name="gender" class="custom-control-input" {{$admin->gender=="Other" ? 'checked' : ''}} value="Other">
                            <label class="custom-control-label" for="radionOther">@lang('title.other')</label>
                          </div>
                      </div>
                   </div>

                   <div class="form-group">
                       <label>@lang('seller.address')</label>
                      <textarea class="form-control" name="address" cols="20" rows="4" placeholder="@lang('seller.enter_address')">{{$admin->address}}</textarea>
                   </div>

                   <div class="form-group mb-0">
                       <div>
                           <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 submit_button">
                               @lang('seller.save_changes')
                           </button>
                       </div>
                   </div>
               </form>
       
           </div>
       </div>
     </div>
   </div>
@endsection
@section('js')
  <script>
      $(document).ready(function(){


     $('body').on('submit','#submit_form',function(e){
               e.preventDefault();
               let formDta = new FormData(this);
            $(".submit_button").html("{{trans('admin.processing')}}"+"...").prop('disabled', true)
         
               $.ajax({
                 url: $(this).attr('data-action'),
                 method: "POST",
                 data: formDta,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success:function(response){
                      let data=JSON.parse(response);
                     if (data.status==200) 
                     {
                        toastr.success(data.message);
                        $(".submit_button").html("{{trans('admin.save_changes')}}").prop('disabled', false)
                       
                     }else
                     {
                        toastr.error(data.message);
                        $(".submit_button").html("{{trans('admin.save_changes')}}").prop('disabled', false)
                     }
     
                 },

                 error:function(error){
                        //console.log(error.responseJSON.errors.phone['0']);
                    $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+`<i class="fas fa-exclamation-triangle"></i> `+error.responseJSON.errors.phone['0']+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
                    </div>`).show();
                     $(".submit_button").html("{{trans('admin.save_changes')}}").prop('disabled', false)
                                  
                 }

               });
         });

     // trigger image profile image feild 
     $('body').on('click','.upload_button',function(){
           $('.get_image').trigger('click')
       })

     // change image 

     $('.get_image').on('change',function(){
         const profile_image_path = document.querySelector('#profile_image_path');
         const image_path = document.querySelector('#image_path').files[0];
         const reader = new FileReader();
         reader.addEventListener("load", function () {
           profile_image_path.src = reader.result;
         }, false);

         if (image_path) {
           reader.readAsDataURL(image_path);
         }
     });
        
      })
  </script>
@endsection()