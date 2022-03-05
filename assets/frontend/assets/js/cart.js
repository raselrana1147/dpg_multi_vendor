 $(document).ready(function(){

  $('body').on('submit','#submit_cart_form',function(e){
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
             let data=JSON.parse(response)
              
             if (data.type=="success") 
             {
              toastr.success(data.message);
              $('.cart-count').html(data.total_item)
              $('.cart-total').html(data.total_price);
              $('.cart-item-added').html(data.carts);

              
             }else
             {
              toastr.error(data.message);
             }
         },

         error:function(response){}

       });
  });
  /// cart remove

  $('body').on('click','.delete_cart',function(e){
    e.preventDefault();
    let cart_id=$(this).attr('cart_id');
         $.ajax({
            url:$(this).attr('data-action'),
            method:'post',
            data:{cart_id:cart_id},
            success:function(response){
               let data=JSON.parse(response)
               if (data.type=="success") 
               {
                toastr.success(data.message);
                $(".cart-count").html(data.total_item)
                $(".cart-item-added").html(data.carts);
                $('.cart-total').html(data.total_price);
                $(".sub_total").html(data.total_price);
                $(".grand_total").html(data.grand_total);
                $('.cart_row'+cart_id).hide();
                if (data.total_item==0) 
                {
                    $('.cart-section').html('<h4 class="text-center">Empty Cart</h4>')
                }
               }
            }
         }); 
  })

    /// cart update

  $('body').on('change','.update_cart',function(e){
    e.preventDefault();
    
    let cart_id=$(this).attr('cart_id');
    let quantity=$(this).val();
    let color_id=$(this).attr('color_id');
    let size_id=$(this).attr('size_id');
    let product_id=$(this).attr('product_id');

    let data=
           {
             "cart_id":cart_id,
             "quantity":quantity,
             "color_id":color_id,
             "size_id":size_id,
             "product_id":product_id
          }

         $.ajax({
            url:$(this).attr('data-action'),
            method:'post',
            data:data,
            success:function(response){
               let data=JSON.parse(response)
               if (data.type=="success") 
               {
                 $('.cart-total').html(data.total_price);
                 $(".sub_total").html(data.total_price);
                 $(".grand_total").html(data.grand_total);
                 $(".each_cart_price"+cart_id).html(data.each_cart_price);
                 toastr.success(data.message);
                
               }else
               {
                 toastr.error(data.message);
               }
            }
         }); 
  })



})