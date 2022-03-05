$(document).ready(function(){
	$('body').on('submit','#kt_sign_in_form',function(e){
              	
                e.preventDefault();
                let formDta = new FormData(this);
                var lang='"+{{__("seller.processing")}}+"';
                
                $('.submit_button').text("Processing").prop('disabled',true);
                 $('#message_area').html('<div class="alert alert-success">Processing...</div>').show();

                $.ajax({
                  url: $(this).attr('data-action'),
                  method: "POST",
                  data: formDta,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success:function(response){

                    let data=JSON.parse(response);

                    if(data.status==200){
                        $('#message_area').html('<div class="alert alert-success">Successfull !!!</div>').show();
                        window.location = data.route
                    }else{
                       
                        $('#message_area')
                        .html('<div class="alert alert-danger">'+data.message+'</div>').show();
                         $('.submit_button').text("Sing In").prop('disabled',false);
                    }
                  },

                });
          })
})