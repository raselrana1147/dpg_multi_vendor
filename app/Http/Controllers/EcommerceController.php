<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller\Product;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Slider;
use App\Models\Seller\Stock;
use Illuminate\Http\Response;
use Session;
use Lang;
use App\Models\Review;

class EcommerceController extends Controller
{
   
    public function index()
    {
  
    	$features=Product::where('featured',"=","0")->latest()->take(12)->get();
    	$top_sales=Product::where('top_sale',"=","0")->latest()->take(12)->get();
    	$trendings=Product::where('trending',"=","0")->latest()->take(12)->get();
    	$brands=Brand::latest()->get();
    	$products         =Product::latest()->paginate(12);
    	$recommendeds     =Product::all()->random(10);
      $sliders          =Slider::latest()->get();
      $latest_categories=Category::whereNull('parent_id')->latest()->take(4)->get();
    	
    	return view('index',compact("products","recommendeds","brands","features","top_sales","trendings","sliders","latest_categories"));
    }

  public  function category_wise($id)
    {
       
       $brands=Brand::latest()->get();
       $category=Category::findOrFail($id);
       return view('user.pages.category_wise',compact("category","brands"));
    }


     public function load_more_data(Request $request)
     {
       $products=Product::latest()
                ->offset($request['start'])
                ->limit($request['limit'])
                ->get();
                  $setProduct='';
                  
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.=' <li class="col-wd-3 col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner p-md-3 row no-gutters">
                                            <div class="col col-lg-auto product-media-left">
                                                <a href="'.route('product.detail',$product->slug).'" class="max-width-150 d-block"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="Image Description"></a>
                                            </div>
                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                <div class="mb-4">
                                                    <div class="mb-2"><a href="'.route('product.category_wise',$product->category_id).'" class="font-size-12 text-gray-5">'.$product->category->category_name.'</a></div>
                                                    <h5 class="product-item__title"><a href="'.route('product.detail',$product->slug).'" class="text-blue font-weight-bold">'.$product->name.'<a></h5>
                                                </div>
                                                <div class="flex-center-between mb-3">
                                                    <div class="prodcut-price">
                                                        <div class="text-gray-100">'.currency().$product->current_price.'</div>
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="'.route('product.detail',$product->slug).'" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="javascript:;" class="text-gray-6 font-size-13 add_to_comparelist" product_id="'.$product->id.'" data-action="'.route('add_to_comparelist').'"><i class="ec ec-compare mr-1 font-size-15 " ></i>'.trans('title.compare').'</a>
                                                <a href="javascript:;" class="text-gray-6 font-size-13 add_to_wishlist" product_id="'.$product->id.'" data-action="'.route('add_to_wishlist').'"><i class="ec ec-favorites mr-1 font-size-15">
                                                </i>'.trans('title.add_to_Wishlist').'</a>
                                     </div>
                                 </div>
                              </div>
                         </div>
                      </div>
                </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;
    }


    public function load_cat_product(Request $request)
    {
         $products=Product::latest()->where('category_id',$request->category_id)
                  ->offset($request['start'])
                  ->limit($request['limit'])
                  ->get();
                    $setProduct='';
           if (count($products)>0) {
              foreach ($products as $product) {
                 $setProduct.='<li class="col-6 col-md-2 product-item">
                    <div class="product-item__outer h-100 w-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2">
                                    <a href="'.route('product.detail',$product->slug).'" class="d-block text-center"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="'.$product->name.'"></a>
                                </div>
                                <h5 class="text-center mb-1 product-item__title"><a href="'.route('product.detail',$product->slug).'" class="font-size-15 text-gray-90">'.$product->name.'</a></h5>
                            </div>
                        </div>
                    </div>
                </li>';
              }
           }else{
             $setProduct.='';
           }

          echo $setProduct;
    }

    public  function subcategory_wise($id)
    {
       $brands=Brand::latest()->get();
       $subcategory=Category::findOrFail($id);
       return view('user.pages.subcategory_wise',compact("subcategory","brands"));
    }
   public function load_subcat_product(Request $request)
    {
         $products=Product::latest()->where('sub_category_id',$request->sub_category_id)
                  ->offset($request['start'])
                  ->limit($request['limit'])
                  ->get();
                    $setProduct='';
           if (count($products)>0) {
              foreach ($products as $product) {
                 $setProduct.='<li class="col-6 col-md-2 product-item">
                    <div class="product-item__outer h-100 w-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2">
                                    <a href="'.route('product.detail',$product->slug).'" class="d-block text-center"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="'.$product->name.'"></a>
                                </div>
                                <h5 class="text-center mb-1 product-item__title"><a href="'.route('product.detail',$product->slug).'" class="font-size-15 text-gray-90">'.$product->name.'</a></h5>
                            </div>
                        </div>
                    </div>
                </li>';
              }
           }else{
             $setProduct.='';
           }

          echo $setProduct;

    }


    public  function brand_wise_product($id)
    {
       $brands=Brand::latest()->get();
       $brand=Brand::findOrFail($id);
       return view('user.pages.brand_wise',compact("brand","brands"));
    }
   public function load_brand_product(Request $request)
    {
         $products=Product::latest()->where('brand_id',$request->brand_id)
                  ->offset($request['start'])
                  ->limit($request['limit'])
                  ->get();
                    $setProduct='';
           if (count($products)>0) {
              foreach ($products as $product) {
                 $setProduct.='<li class="col-6 col-md-2 product-item">
                    <div class="product-item__outer h-100 w-100">
                        <div class="product-item__inner px-xl-4 p-3">
                            <div class="product-item__body pb-xl-2">
                                <div class="mb-2">
                                    <a href="'.route('product.detail',$product->slug).'" class="d-block text-center"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="'.$product->name.'"></a>
                                </div>
                                <h5 class="text-center mb-1 product-item__title"><a href="'.route('product.detail',$product->slug).'" class="font-size-15 text-gray-90">'.$product->name.'</a></h5>
                            </div>
                        </div>
                    </div>
                </li>';
              }
           }else{
             $setProduct.='';
           }

          echo $setProduct;

    }


    public function load_related_product(Request $request)
    {
       $products=Product::latest()->where('category_id',$request->category_id)
                ->offset($request['start'])
                ->limit($request['limit'])
                ->get();
                  $setProduct='';
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.='<li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"><a href="'.route('product.detail',$product->slug).'" class="font-size-12 text-gray-5"></a></div>
                                        <h5 class="mb-1 product-item__title"><a href="'.route('product.detail',$product->slug).'" class="text-blue font-weight-bold">'.$product->name.'</a></h5>
                                        <div class="mb-2">
                                            <a href="'.route('product.detail',$product->slug).'" class="d-block text-center"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price d-flex align-items-center position-relative">

                                                <ins class="font-size-20 text-red text-decoration-none">'.currency(). $product->previous_price.'</ins>

                                                <del class="font-size-12 tex-gray-6 position-absolute bottom-100">'.currency(). $product->current_price.'</del>
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="href="'.route('product.detail',$product->slug).'"" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">

                                            <a href="javascript:;" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15 add_to_comparelist" product_id="'.$product->slug.'" data-action="'.route('add_to_comparelist').'"></i>'.trans('title.compare').'</a>
                                            <a href="javascript:;" class="text-gray-6 font-size-13 add_to_wishlist"><i class="ec ec-favorites mr-1 font-size-15"></i>'.trans('title.add_to_Wishlist').'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;
    }


    public function product_detail($slug)
    {
      $brands=Brand::latest()->get();
      $product=Product::where('slug',$slug)->first();
      $stocks=Stock::where('product_id',$product->id)->get();
      $stock_check=Stock::where('product_id',$product->id)->where('quantity','>','0')->get();
      $product->increment('view');
      $product->update();

      // review are clculatting
      $total_review=Review::where('product_id',$product->id)->count();
      $avarage=round(Review::where('product_id',$product->id)->avg('ratting'),2);
      $max_ratting=Review::where('product_id',$product->id)->max('ratting');

      $one_ratting=0;
      $two_ratting=0;
      $three_ratting=0;
      $four_ratting=0;
      $five_ratting=0;

      if ($total_review>0) {
        
        $one_ratting=round((Review::where(['product_id'=>$product->id,'ratting'=>1])->count()*100)/$total_review,2);
        $two_ratting=round((Review::where(['product_id'=>$product->id,'ratting'=>2])->count()*100)/$total_review,2);
        $three_ratting=round((Review::where(['product_id'=>$product->id,'ratting'=>3])->count()*100)/$total_review,2);
        $four_ratting=round((Review::where(['product_id'=>$product->id,'ratting'=>4])->count()*100)/$total_review,2);
        $five_ratting=round((Review::where(['product_id'=>$product->id,'ratting'=>5])->count()*100)/$total_review,2);
      }
     
      return view('user.detail',compact("brands","product","stocks","stock_check","total_review","max_ratting","avarage",
        "one_ratting","two_ratting","three_ratting","four_ratting","five_ratting"));
    }

    public function find_size(Request $request)
    {
      $sizes=Stock::with('size')->where([
              'product_id'=>$request->product_id,
              'color_id'=>$request->color_id])->get();

      return response()->json([
         'sizes' =>$sizes,
         'status_code' => 200
       ], Response::HTTP_OK);
    }

    public function available_quantity(Request $request)
    {
     // dd($request->all());
      $quantity=Stock::where(
             [
              'product_id'=>$request->product_id,
              'size_id'=>$request->size_id,
              'color_id'=>$request->color_id,
              ]
         )->first();

      return response()->json([
         'quantity' =>$quantity,
         'status_code' => 200
       ], Response::HTTP_OK);
    }



    public function product_search(Request $request)
    {

      $data=['search_key'=>$request->search_key,'category_id'=>$request->category_id];
      $brands=Brand::latest()->get();
      return view('user.pages.search_product',compact('data','brands'));
    }

    public function load_search_product(Request $request)
    {

       $products=Product::latest()->where('category_id',$request->category_id)
                ->offset($request['start'])
                ->limit($request['limit'])
                ->get();

       if (!empty($request->search_key) && empty($request->category_id)) {
           $products=Product::where('name',"LIKE","%$request->search_key%")
            ->offset($request['start'])
            ->limit($request['limit'])
            ->get();
       }elseif (empty($request->keyword) && !empty($request->category_id)) {
           $products=Product::where('category_id',"LIKE","%$request->category_id%")
           ->offset($request['start'])
           ->limit($request['limit'])
           ->get();
       }elseif (!empty($request->keyword) && !empty($request->category_id)) {

           $products=Product::where('category_id',"LIKE","%$request->category_id%")
           ->where('name',"LIKE","%$request->search_key%")
           ->offset($request['start'])
           ->limit($request['limit'])
           ->get();

       }else{
          $products=Product::latest()
           ->offset($request['start'])
           ->limit($request['limit'])
          ->get();
      }

          $setProduct='';
         if (count($products)>0) {
            foreach ($products as $product) {
               $setProduct.='<li class="col-6 col-md-2 product-item">
                  <div class="product-item__outer h-100 w-100">
                      <div class="product-item__inner px-xl-4 p-3">
                          <div class="product-item__body pb-xl-2">
                              <div class="mb-2">
                                  <a href="'.route('product.detail',$product->slug).'" class="d-block text-center"><img class="img-fluid" src="'.asset('assets/backend/image/product/small/'.$product->thumbnail).'" alt="'.$product->name.'"></a>
                              </div>
                              <h5 class="text-center mb-1 product-item__title"><a href="'.route('product.detail',$product->slug).'" class="font-size-15 text-gray-90">'.$product->name.'</a></h5>
                          </div>
                      </div>
                  </div>
              </li>';
            }
         }else{
           $setProduct.='';
         }

        echo $setProduct;
    }
}
