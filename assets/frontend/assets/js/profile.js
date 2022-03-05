 $(document).ready(function(){

  $('body').on('submit','#change_password',function(e){
       e.preventDefault();
       let formDta = new FormData(this);
       $('.show_spinner').show();
       $.ajax({
         url: $(this).attr('data-action'),
         method: "POST",
         data: formDta,
         cache: false,
         contentType: false,
         processData: false,
         success:function(response){
            let data=JSON.parse(response);
            if (data.status==200) {
                    $('.message_section').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">`+`<i class="far fa-check-circle"></i> `+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
                    </div>`).show();
                    $("#change_password")[0].reset();
                    $('.show_spinner').hide();

            }else{
                $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+`<i class="fas fa-exclamation-triangle"></i> `+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                 </button>
                </div>`).show();
                 $('.show_spinner').hide();
            }
         },
       });
  });
  //profile update
  $('body').on('submit','#update_profile',function(e){
       e.preventDefault();
       let formDta = new FormData(this);
       $('.show_spinner').show();
       $.ajax({
         url: $(this).attr('data-action'),
         method: "POST",
         data: formDta,
         cache: false,
         contentType: false,
         processData: false,
         success:function(response){
            let data=JSON.parse(response);
            if (data.status==200) {
                    $('.message_section').html(`<div class="alert alert-success alert-dismissible fade show" role="alert">`+`<i class="far fa-check-circle"></i> `+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
                    </div>`).show();
                    $('.show_spinner').hide();

            }else{
                $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+`<i class="fas fa-exclamation-triangle"></i> `+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                 </button>
                </div>`).show();
                 $('.show_spinner').hide();
            }
         },

         error:function(error){
              
              //console.log(error.responseJSON.errors.phone['0']);
              $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+`<i class="fas fa-exclamation-triangle"></i> `+error.responseJSON.errors.phone['0']+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
              </div>`).show();
               $('.show_spinner').hide();
           }
       });
  });

  // trigger image profile image feild 
  $('body').on('click','.upload_button',function(){
        $('.get_image').trigger('click')
    })

  //=====track order====

  $('body').on('submit','#track_order',function(e){
       e.preventDefault();
       let formDta = new FormData(this);
       $('.show_spinner').show();
       $.ajax({
         url: $(this).attr('data-action'),
         method: "POST",
         data: formDta,
         cache: false,
         contentType: false,
         processData: false,
         success:function(response){
            let data=JSON.parse(response);
            console.log(data.message);
            if (data.status==200) {
                    $('#order_track_area').html(data.message)
                    $('.show_spinner').hide();

            }else{

                $('.message_section').html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">`+`<i class="fas fa-exclamation-triangle"></i> `+data.message+`<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                 </button>
                </div>`).show();
                $('#order_track_area').html("")
                 $('.show_spinner').hide();
            }
            
         },
       });
  });



})