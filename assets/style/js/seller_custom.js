$(function($){
	'use strict';
	  var base_url = $('#base_url').val();
      // load sub category
        $('body').on('change','#find_sub_category',function(){
                let category_id=$(this).val();
                $.ajax({
                url: $(this).attr('data-action'),
                method: "POST",
                data:{category_id:category_id},
                success:function(data){
                  var setItem='';
                  data.subcategoryes.forEach(function(item,index){
                      setItem+='<option value="'+item.id+'">'+item.category_name+'</option>'
                  });
                   $('.load_sub_cat').html(setItem);
                },

                error:function(response){
                }
              });
        });

      // check whole sell
       $('#sale_type_whole').on('click',function(){
         
          if ($(this).is(':checked')) {
            $('.show_whole_section').show();
            $('#whole_sale_quantity').attr('required', 'true');
          }
        
        });

         $('#sale_type_retail').on('click',function(){
            if ($(this).is(':checked')) {
              $('.show_whole_section').hide();
              $('#whole_sale_quantity').removeAttr('required');
            }
          })


         // SEO Section
         $('#will_seo').on('click',function(){
            if ($(this).is(':checked')) {
                $('.show_seo_section').show();
                 $('#meta_title').attr('required', 'true');
                 $('#meta_keyword').attr('required', 'true');
                 $('#meta_description').attr('required', 'true');
            }else{
               $('.show_seo_section').hide();
                $('#meta_title').removeAttr('required');
                $('#meta_keyword').removeAttr('required');
                $('#meta_description').removeAttr('required');
            }
          })


        //=======show product status==========

        $('body').on('click','.show_product_status',function(e){
          e.preventDefault();
          let product_id=$(this).attr('product_id');
           $.ajax({
              url: $(this).attr('data-action'),
              method: "POST",
              data:{product_id:product_id},
              success:function(response){
                let data=response.product;
                
                $(".store_product_id").val(data.id)

                  if (data.flash_deal==0) 
                  {
                    $('#flash_deal').prop('checked', true)
                  }else
                  {
                    $('#flash_deal').prop('checked', false)
                  }

                  if (data.featured==0) 
                  {
                    $('#featured').prop('checked', true)
                  }else
                  {
                    $('#featured').prop('checked', false)
                  }

                  if (data.best_sale==0) 
                  {
                    $('#best_sale').prop('checked', true)
                  }else
                  {
                    $('#best_sale').prop('checked', false)
                  }

                  if (data.hot==0) 
                  {
                    $('#hot').prop('checked', true)
                  }else
                  {
                    $('#hot').prop('checked', false)
                  }


                  if (data.top_sale==0) 
                  {
                    $('#top_sale').prop('checked', true)
                  }else
                  {
                    $('#top_sale').prop('checked', false)
                  }

                  if (data.big_save==0) 
                  {
                    $('#big_save').prop('checked', true)
                  }else
                  {
                    $('#big_save').prop('checked', false)
                  }


                  if (data.new_arrival==0) 
                  {
                    $('#new_arrival').prop('checked', true)
                  }else
                  {
                    $('#new_arrival').prop('checked', false)
                  }

                  if (data.trending==0) 
                  {
                    $('#trending').prop('checked', true)
                  }else
                  {
                    $('#trending').prop('checked', false)
                  }
              },
           })

        });


        $('body').on('click','.change_product_status',function(){

              let type=$(this).attr('status_type');
              let product_id=$(".store_product_id").val();

              $.ajax({
                 url: $(".store_product_id").attr('data-action'),
                 method: "POST",
                 data:{product_id:product_id,type:type},
                 success:function(data){
                   
                    toastr.success(data.message);
                 },
              })
        })
});