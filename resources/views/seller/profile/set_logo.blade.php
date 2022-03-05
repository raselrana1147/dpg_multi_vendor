@extends("layouts.seller")
@section("seller_title","DPG Seller| Set Logo")
@section("seller_breadcrumb",trans('seller.set_logo'))
@section("seller_content")
 <div class="message_section" style="display: none"></div>
<div class="row pb-4">
 <div class="offset-5">
    <div class="text-center">
       <img id="profile_image_path" src="{{Auth::user()->shop_logo !=null ? asset('assets/backend/image/shop_logo/'.Auth::user()->shop_logo) : asset('assets/backend/image/'.default_image())}}"  class="profile_image" alt="customer image"><br>
    
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
    
            <form id="submit_form" class="custom-validation" data-action="{{ route('seller.add_shop_logo') }}"  method="POST" enctype="multipart/form-data">
             @csrf
                <input type="hidden" name="id" value="{{$seller->id}}">

                <input type="file" id="image_path" name="logo" class="d-none get_image">
                <div class="form-group">
                    <label>@lang('seller.shop_name')</label>
                    <input type="text" class="form-control" name="shop_name" value="{{$seller->shop_name}}" required placeholder="@lang('seller.shop_name')"/>
                </div>
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
@section('seller_js')

    <script>
        $(document).ready(function(){


       $('body').on('submit','#submit_form',function(e){
                 e.preventDefault();
                 let formDta = new FormData(this);
              $(".submit_button").html("{{trans('seller.processing')}}"+"...").prop('disabled', true)
           
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
                          $(".submit_button").html("{{trans('seller.save_changes')}}").prop('disabled', false)
                         
                       }else
                       {
                          toastr.error(data.message);
                          $(".submit_button").html("{{trans('seller.save_changes')}}").prop('disabled', false)
                       }
       
                   },

                   error:function(error){}

                 });
           });

       // trigger logo image feild 
       $('body').on('click','.upload_button',function(){
             $('.get_image').trigger('click')
         })
       // change logo 
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
