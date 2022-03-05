@extends("layouts.admin")
@section("title","DPG Admin | Category Create")
@section("breadcrumb",trans('admin.create_cat_or_sub_cat'))
@section("content")
      <div class="message_section" style="display: none">
        
      </div>
   <div class="row">

       <div class="col-lg-8 offset-2">
           <div class="card">
               <div class="card-body">
   					 <a href="javascript:history.back();" class="btn btn-primary btn-icon float-right mb-2">
   					 	   <span class="btn-icon-label"><i class="fas fa-arrow-left mr-2"></i></span>@lang('admin.back')</a>
                   <form id="submit_form" class="custom-validation" data-action="{{ route('admin.category_store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                       <div class="form-group">
                           <label>@lang('admin.category_name')</label>
                           <input type="text" class="form-control" name="category_name" required placeholder="@lang('admin.enter_name')"/>
                       </div>

                        <div class="form-group">
                           <label>@lang('admin.parent_of')</label>
                           
                            <select class="form-control" name="parent_id">
                              <option value="">@lang('admin.select_category')</option>
                              @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                              @endforeach
                            </select>               
                       </div>
   
                       <div class="form-group">
                           <label>@lang('admin.image')</label>
                           <div>
                               <input type="file" name="image" class="form-control dropify" multiple="true" />
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
       </div> <!-- end col -->
   </div> <!-- end row -->
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
                        $("#submit_form")[0].reset();
                        $(".submit_button").text("Submit").prop('disabled', false)
                        $('.message_section').html('').hide();
                    },

                    error:function(response){
                        var errors=response.responseJSON
                         if (response.responseJSON.errors['category_name']) 
                         {
                             $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+response.responseJSON.errors['category_name']+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                            </button>
                           </div>`).show();
                           $(".submit_button").text("Submit").prop('disabled', false)
                          }     
                    }

                  });
            });

    })
</script>

@endsection