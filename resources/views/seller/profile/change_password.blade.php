@extends("layouts.seller")
@section("seller_title","DPG Seller| Stock List")
@section("seller_breadcrumb",trans('seller.change_password'))
@section("seller_content")
 <div class="message_section" style="display: none"></div>


<div class="row">
  <div class="col-8 offset-2">
    <div class="card">
        <div class="card-body">
    
            <form id="submit_form" class="custom-validation" data-action="{{ route('seller.update_password') }}"  method="POST">
             @csrf
                <div class="form-group">
                    <label>@lang('seller.old_password')</label>
                    <input type="password" class="form-control" name="old_password" required placeholder="@lang('seller.enter_old_password')"/>
                </div>

                <div class="form-group">
                    <label>@lang('seller.new_password')</label>
                    <input type="password" class="form-control" name="new_password" required placeholder="@lang('seller.enter_new_password')"/>
                </div>
                 <div class="form-group">
                    <label>@lang('seller.confirm_password')</label>
                    <input type="password" class="form-control" name="password_confirmation" required placeholder="@lang('seller.enter_confirm_password')"/>
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
                          $("#submit_form")[0].reset();
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
