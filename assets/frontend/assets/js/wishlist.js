 $(document).ready(function(){

	$('body').on('click','.add_to_wishlist',function(){
		 
		   let product_id=$(this).attr("product_id");
		  
		   $.ajax({
		     url: $(this).attr('data-action'),
		     method: "POST",
		     data: {product_id:product_id},
		     
		     success:function(response){
		         let data=JSON.parse(response)

		        if (data.status==401) {
		        	 toastr.warning(data.message);
		        	 $('#sidebarNavToggler').trigger('click')
		        }else if(data.status==201){
		        	toastr.info(data.message);
		        }else{
		        	toastr.success(data.message);
		        } 
		     },
		   });
	});

	$('body').on('click','.delete_wishlist',function(e){
		e.preventDefault();
		let wishlist_id=$(this).attr('wishlist_id');

	       $.ajax({
	          url:$(this).attr('data-action'),
	          method:'post',
	          data:{wishlist_id:wishlist_id},
	          success:function(response){
	             let data=JSON.parse(response)
	             if (data.type=="success") 
	             {
	             	toastr.success(data.message);
	             	$(".wishlist_row"+wishlist_id).hide();
	             	
	             }

	             if (data.total_wishlist==0) 
	             {
	                 $('.wishlist-section').html('<h4 class="text-center">Your wishlist is cleared</h4>')
	             }
	          }
	       }); 
	})
	
})