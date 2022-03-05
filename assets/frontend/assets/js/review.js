 $(document).ready(function(){
   var base_url = $('#base-url').val();

   // add review
  $('body').on('submit','#submit_ratting',function(e){
       e.preventDefault();
       let formDta = new FormData(this);
       $.ajax({
         url: $(this).attr('data-action'),
         method: "POST",
         data: formDta,
         cache: false,
         contentType: false,
         processData: false,
         success:function(response){
           let data=JSON.parse(response);
          // console.log(data.review_info.total_review);
           toastr.success(data.message);
           $('.review-section').html(data.review);
           $(".total_review").html(data.review_info.total_review);
           $(".avarage_review").html(data.review_info.avarage);
           
           $(".five_progress").html(' <div class="progress-bar" role="progressbar" style="width:'+data.review_info.five_ratting+'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
           $(".four_progress").html(' <div class="progress-bar" role="progressbar" style="width:'+data.review_info.four_ratting+'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
           $(".three_progress").html(' <div class="progress-bar" role="progressbar" style="width:'+data.review_info.three_ratting+'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
           $(".two_progress").html(' <div class="progress-bar" role="progressbar" style="width:'+data.review_info.two_ratting+'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
           $(".one_progress").html(' <div class="progress-bar" role="progressbar" style="width:'+data.review_info.one_ratting+'%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>');
         },
         error:function(response){}

       });
  });

// load all review
           $('body').on('click','.sell_all_review',function(e){
           
             // load more data for all collection
               let page_num_review=$('.sell_all_review').attr('page_num_review');
                let product_id=$('.sell_all_review').attr('product_id')
               if (page_num_review !='undefined' && page_num_review =='1') {
                    let start=0;
                    let limit=10;
                    let action = true;
                   function load_more_data(start,limit){
                     $.ajax({
                         url: base_url+"product/load_more_review",
                         method:'POST',
                         data:{product_id:product_id,start:start,limit:limit},
                         success:function(response){
                            let data=JSON.parse(response);
                           $(".review-section").append(data.set_review);
                           $(".total_review").html(data.total_review);
                           if (data.set_review =='') {
                               $('.no_more_review').html('<span><strong>No more data</strong></span>').show();
                                $("#load_more_review").hide();
                               action = false;
                           }else{
                              $('.no_more_review').html('').hide();
                                $("#load_more_review").show();
                                action = true;
                           }
                         }
                     });
                   }
                   if(action)
                    {
                       load_more_data(start, limit);
                       action = true;
                    }
                    $('body').on('click','#load_more_review',function(){
                      start = limit + start;
                      load_more_data(start, limit);
                    })
               }
           });


})