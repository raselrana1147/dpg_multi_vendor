$(function($){
	'use strict';
	  var base_url = $('#base-url').val();

      // load more data for all collection
        let page_num_collection=$('.see_all_collection').attr('page_num_collection');
        if (page_num_collection !='undefined' && page_num_collection =='1') {
            let start=0;
             let limit=12;
             let action = true;
            function load_more_data(start,limit){
              $.ajax({
                  url: base_url+"product/load_more_data",
                  method:'POST',
                  data:{start:start,limit:limit},
                  success:function(data){
                    $(".see_all_collection").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
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
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data(start, limit);
             })
        }/*=======End load more========*/



        // load more data for category product
         let page_num_cat=$('.sell_category_product').attr('page_num_cat');
         let category_id=$('.sell_category_product').attr('category_id');
        if (page_num_cat !='undefined' && page_num_cat =='1') {
             let start=0;
             let limit=12;
             let action = true;
            function load_more_data_cat(start,limit){
              $.ajax({
                  url: base_url+"product/load_category",
                  method:'POST',
                  data:{category_id:category_id,start:start,limit:limit},
                  success:function(data){
                    $(".sell_category_product").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
                         action = true;
                    }
                  }
              });
            }
            if(action)
             {
                load_more_data_cat(start, limit);
                action = true;
             }
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data_cat(start, limit);
             })
       
        }/*=======End load more========*/


         // load more data for sub category product
         let page_num_subcat=$('.sell_subcategory_product').attr('page_num_subcat');
         let sub_category_id=$('.sell_subcategory_product').attr('sub_category_id');
        if (page_num_subcat !='undefined' && page_num_subcat =='1') {
             let start=0;
             let limit=12;
             let action = true;
            function load_more_data_subcat(start,limit){
              $.ajax({
                  url: base_url+"product/load_subcategory",
                  method:'POST',
                  data:{sub_category_id:sub_category_id,start:start,limit:limit},
                  success:function(data){
                    $(".sell_subcategory_product").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
                         action = true;
                    }
                  }
              });
            }
            if(action)
             {
                load_more_data_subcat(start, limit);
                action = true;
             }
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data_subcat(start, limit);
             })
       
        }/*=======End load more========*/


        // load more data for sub category product
         let page_num_brand=$('.sell_brand_product').attr('page_num_brand');
         let brand_id=$('.sell_brand_product').attr('brand_id');
        if (page_num_brand !='undefined' && page_num_brand =='1') {
             let start=0;
             let limit=12;
             let action = true;
            function load_more_data_brand(start,limit){
              $.ajax({
                  url: base_url+"product/load_brand_wise",
                  method:'POST',
                  data:{brand_id:brand_id,start:start,limit:limit},
                  success:function(data){
                    $(".sell_brand_product").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
                         action = true;
                    }
                  }
              });
            }
            if(action)
             {
                load_more_data_brand(start, limit);
                action = true;
             }
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data_brand(start, limit);
             })
       
        }/*=======End load more========*/

         // load more data for ralated product
         let page_num_related=$('.seee_related_product').attr('page_num_related');
         let cat_id=$('.seee_related_product').attr('category_id');
        if (page_num_related !='undefined' && page_num_related =='1') {
             let start=0;
             let limit=12;
             let action = true;
            function load_more_data_related(start,limit){
              $.ajax({
                  url: base_url+"product/load_related_product",
                  method:'POST',
                  data:{category_id:cat_id,start:start,limit:limit},
                  success:function(data){
                    $(".seee_related_product").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
                         action = true;
                    }
                  }
              });
            }
            if(action)
             {
                load_more_data_related(start, limit);
                action = true;
             }
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data_related(start, limit);
             })
       
        }/*=======End load more========*/



        // load more data for category product
         let page_num_search=$('.sell_search_product').attr('page_num_search');
         let catid=$('.sell_search_product').attr('category_id');
        if (page_num_search !='undefined' && page_num_search =='1') {
             let start=0;
             let limit=12;
             let action = true;
            function load_more_data_search(start,limit){
              $.ajax({
                  url: base_url+"product/load_search_product",
                  method:'POST',
                  data:{category_id:catid,start:start,limit:limit},
                  success:function(data){
                    $(".sell_search_product").append(data);
                    if (data =='') {
                        $('.no_more_data').html('<span><strong>No More Data</strong></span>').show();
                         $("#load_more").hide();
                        action = false;
                    }else{
                       $('.no_more_data').html('').hide();
                         $("#load_more").show();
                         action = true;
                    }
                  }
              });
            }
            if(action)
             {
                load_more_data_search(start, limit);
                action = true;
             }
             $('body').on('click','#load_more',function(){
               start = limit + start;
               load_more_data_search(start, limit);
             })
        
        }/*=======End load more========*/
 
    $('body').on('click','.delete_item',function(){
                let item_id=$(this).attr('item_id');
                swal({
                  title: "Do you want to delete?",
                  icon: "info",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       $.ajax({
                          url:$(this).attr('data-action'),
                          method:'post',
                          data:{item_id:item_id},
                          success:function(data){
                             toastr.success(data.message);
                             $('#tables_item').DataTable().ajax.reload(); 
                          }
                       }); 
                  } 
                });
          })  
});