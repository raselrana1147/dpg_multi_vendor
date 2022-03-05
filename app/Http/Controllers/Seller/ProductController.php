<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Seller\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Brand;
use App\Models\Admin\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use Validator;
use Image;

class ProductController extends Controller
{
    
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('seller');
     }


    public function datatable()
    {
       $datas=Product::where('seller_id',"=",Auth::user()->id)->orderBy('id','DESC')->get();
      
        return DataTables::of($datas)

         ->editColumn('thumbnail',function(Product $data){

                  $url=$data->thumbnail ? asset("assets/backend/image/product/small/".$data->thumbnail) 
                  :asset("assets/backend/image/default.png");
                  return '<img src='.$url.' border="0" width="120" height="50" class="img-rounded" />';      
          })

         ->editColumn('name',function(Product $data){
                return '<a target="_blank" href="'.route('product.detail',$data->slug).'">
                 '.$data->name.'
                </a>'; 
          })
         ->editColumn('attribute',function(Product $data){
                 return '<div class="btn-group btn-group-medium" role="group" aria-label="Basic example">
                                  <a href="'.route('seller.gallery_list',$data->id).'" class="btn btn-dark btn-icon">
                                      <span class="btn-icon-label"><i class="fas fa-file-image mr-2"></i></span>'.trans('seller.gallery').'
                                  </a>
                                 <a href="'.route('seller.stock_list',$data->id).'" class="btn btn-dark btn-icon">
                                     <span class="btn-icon-label"><i class="mdi mdi-file-check-outline mr-2"></i></span>'.trans('seller.stock').'
                                 </a>

                                  <a href="javascript:;" data-toggle="modal" class="btn btn-dark btn-icon show_product_status" 
                                  data-target="#product-status" 
                                  data-action="'.route('seller.show_product_status').'" product_id="'.$data->id.'">
                                      <span class="btn-icon-label"><i class="mdi mdi-check-all mr-2"></i></span>'.trans('seller.status').'
                                  </a>
                                  <a href="'.route('product.detail',$data->id).'" class="btn btn-dark btn-icon">
                                      <span class="btn-icon-label"><i class="fas fa-street-view mr-2"></i></span>'.trans('seller.view').'
                                  </a>
                           </div>';
        })
        ->editColumn('action',function(Product $data){
                 return '<a href="'.route('seller.product_edit',$data->id).'" class="btn btn-success btn-sm">
                  <i class="fa fa-edit"></i>
                  </a>
                   <a href="javascript:;" class="btn btn-danger btn-sm delete_item" data-action="'.route('seller.product_delete').'"  item_id="'.$data->id.'">
                   <i class="fa fa-trash"></i>
                  </a>';
        })
       ->rawColumns(['thumbnail','name','attribute','action'])
        ->make(true);
    }

     public function index()
     {

     	return view('seller.product.index');
     }


     public function edit($id)
     {

        $product=Product::findOrFail($id);
        $categories=Category::whereNull('parent_id')->latest()->get();
        $brands=Brand::latest()->get();
        $producttypes=ProductType::latest()->get();
        return view('seller.product.edit',compact('product','categories','brands','producttypes'));
     }

    public function create()
    {

       $categories=Category::whereNull('parent_id')->latest()->get();
       $brands=Brand::latest()->get();
       $producttypes=ProductType::latest()->get();
         
    	 return view('seller.product.create',compact('categories','brands','producttypes'));
    }

    public function store(Request $request)
    {
      
          if ($request->isMethod('post'))
            {
                DB::beginTransaction();
                try{
                    //Product create
                    $product = new Product();
                    $product->name              = $request->name;
                    $product->title             = $request->title;
                    $product->category_id       = $request->category_id;
                    $product->sub_category_id   = $request->sub_category_id;
                    $product->product_type_id   = $request->product_type_id;
                    $product->brand_id          = $request->brand_id;
                    $product->purchase_price    = $request->purchase_price;
                    $product->previous_price    = $request->previous_price;
                    $product->current_price     = $request->current_price;
                    $product->sale_type         = $request->sale_type;
                    $product->whole_sale_quantity= $request->whole_sale_quantity;
                    $product->description       = $request->description;
                    $product->specification     = $request->specification;
                    $product->return_policy     = $request->return_policy;
                    $product->seller_id         = Auth::user()->id;
                    $product->discount          = 0;

                    if (count($request->tags)>0) 
                    {
                      $product->tag = json_encode($request->tags);
                    }

                    if (!empty($request->video_link)) 
                    {
                      $product->video_link= $request->video_link;
                    }

                    if (!empty($request->will_seo)) 
                    {
                      $product->meta_title= $request->meta_title;
                      $product->meta_keyword= json_encode($request->meta_keywords);
                      $product->meta_description= $request->meta_description;

                    }

                    if($request->hasFile('thumbnail')){

                            $image=$request->thumbnail;
                      
                            $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
                            $original_image_path = base_path().'/assets/backend/image/product/original/'.$image_name;
                            $large_image_path = base_path().'/assets/backend/image/product/large/'.$image_name;
                            $medium_image_path = base_path().'/assets/backend/image/product/medium/'.$image_name;
                            $small_image_path = base_path().'/assets/backend/image/product/small/'.$image_name;

                            //Resize Image
                            Image::make($image)->save($original_image_path);
                            Image::make($image)->resize(1920,980)->save($large_image_path);
                            Image::make($image)->resize(1000,850)->save($medium_image_path);
                            Image::make($image)->resize(470,430)->save($small_image_path);
                            $product->thumbnail = $image_name;
                        
                    }

                     $product->save();

                     $data=Product::findOrFail($product->id);
                     $data->slug = Str::slug($request->name,'-').'-'.strtolower(Str::random(3).$data->id.Str::random(3));
                     $data->save();

                      DB::commit();
                      return \response()->json([
                          'message' => trans('seller.item_added'),
                          'status_code' => 200
                      ], Response::HTTP_OK);
                    
                }catch (QueryException $e){
                    DB::rollBack();

                    $error = $e->getMessage();

                    return \response()->json([
                        'error' => $error,
                        'status_code' => 500
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }

    }


    public function update(Request $request)
    {
       if ($request->isMethod('post'))
                  {
                      DB::beginTransaction();
                      try{
                          //Product update
                      
                          $product                    =Product::findOrFail($request->id);
                          $product->name              = $request->name;
                          $product->title             = $request->title;
                          $product->category_id       = $request->category_id;
                          $product->sub_category_id   = $request->sub_category_id;
                          $product->product_type_id   = $request->product_type_id;
                          $product->brand_id          = $request->brand_id;
                          $product->purchase_price    = $request->purchase_price;
                          $product->previous_price    = $request->previous_price;
                          $product->current_price     = $request->current_price;
                          $product->sale_type         = $request->sale_type;
                          $product->discount          = 0;

                          if ($request->sale_type=="retail") {
                             $product->whole_sale_quantity=null;
                          }else{
                            $product->whole_sale_quantity= $request->whole_sale_quantity;
                          }
                          
                         
                          $product->description       = $request->description;
                          $product->specification     = $request->specification;
                          $product->return_policy     = $request->return_policy;
                          $product->seller_id         = Auth::user()->id;


                          if (count($request->tags)>0) 
                          {
                            $product->tag = json_encode($request->tags);
                          }

                          if (!empty($request->video_link)) 
                          {
                            $product->video_link= $request->video_link;
                          }

                          if (!empty($request->will_seo)) 
                          {
                            $product->meta_title= $request->meta_title;
                            $product->meta_keyword= json_encode($request->meta_keywords);
                            $product->meta_description= $request->meta_description;

                          }

                         
                          if($request->hasFile('thumbnail'))
                          {

                                $image=$request->thumbnail;

                              if (File::exists(base_path('/assets/backend/image/product/small/'.$product->thumbnail))) 
                                {
                                  File::delete(base_path('/assets/backend/image/product/small/'.$product->thumbnail));
                                }
                                if (File::exists(base_path('/assets/backend/image/product/medium/'.$product->thumbnail))) 
                                {
                                  File::delete(base_path('/assets/backend/image/product/medium/'.$product->thumbnail));
                                }

                                if (File::exists(base_path('/assets/backend/image/product/large/'.$product->thumbnail)))
                                 {
                                   File::delete(base_path('/assets/backend/image/product/large/'.$product->thumbnail));
                                 }

                                 if (File::exists(base_path('/assets/backend/image/product/original/'.$product->thumbnail)))
                                 {
                                    File::delete(base_path('/assets/backend/image/product/original/'.$product->thumbnail));
                                 }
                          
                                $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
                                $original_image_path = base_path().'/assets/backend/image/product/original/'.$image_name;
                                $large_image_path = base_path().'/assets/backend/image/product/large/'.$image_name;
                                $medium_image_path = base_path().'/assets/backend/image/product/medium/'.$image_name;
                                $small_image_path = base_path().'/assets/backend/image/product/small/'.$image_name;

                                //Resize Image
                                Image::make($image)->save($original_image_path);
                                Image::make($image)->resize(1920,980)->save($large_image_path);
                                Image::make($image)->resize(1000,850)->save($medium_image_path);
                                Image::make($image)->resize(470,430)->save($small_image_path);
                                $product->thumbnail = $image_name;
                              
                          }

                            $product->save();
                            DB::commit();
                            return \response()->json([
                                'message' =>  trans('seller.item_updated'),
                                'status_code' => 200
                            ], Response::HTTP_OK);
                          
                      }catch (QueryException $e){
                          DB::rollBack();

                          $error = $e->getMessage();

                          return \response()->json([
                              'error' => $error,
                              'status_code' => 500
                          ], Response::HTTP_INTERNAL_SERVER_ERROR);
                      }
                  }
    }


    public function delete(Request $request){

     $data=Product::findOrFail($request->item_id);

     if (File::exists(base_path('/assets/backend/image/product/small/'.$data->thumbnail))) 
       {
         File::delete(base_path('/assets/backend/image/product/small/'.$data->thumbnail));
       }
       if (File::exists(base_path('/assets/backend/image/product/medium/'.$data->thumbnail))) 
       {
         File::delete(base_path('/assets/backend/image/product/medium/'.$data->thumbnail));
       }

       if (File::exists(base_path('/assets/backend/image/product/large/'.$data->thumbnail)))
        {
          File::delete(base_path('/assets/backend/image/product/large/'.$data->thumbnail));
        }

        if (File::exists(base_path('/assets/backend/image/product/original/'.$data->thumbnail)))
        {
           File::delete(base_path('/assets/backend/image/product/original/'.$data->thumbnail));
        }
     $data->delete();
     $notification=['alert'=>'success','message'=>'Successfully Delete','status'=>200];

     return \response()->json([
         'message' =>  trans('seller.item_deleted'),
         'status_code' => 200
     ], Response::HTTP_OK);

    }



    public function find_sub_cat(Request $request)
    {
       $subcategoryes=Category::where('parent_id',$request->category_id)->get();

          return \response()->json([
              'subcategoryes' => $subcategoryes,
              'status_code' => 200
          ], Response::HTTP_OK);
     
    }


    public function show_product_status(Request $request)
    {

      $product=Product::findOrFail($request->product_id);

      return \response()->json([
              'product' => $product,
              'status_code' => 200
          ], Response::HTTP_OK);

    }


    public function update_product_status(Request $request)
    {
      $product=Product::findOrFail($request->product_id);

      if ($request->type=="flash_deal") 
      {
          if ($product->flash_deal==0) 
          {
            $product->flash_deal=1;
          }else
          {
             $product->flash_deal=0;
          }
      }elseif ($request->type=="featured") 
      {
          if ($product->featured==0) 
          {
            $product->featured=1;
          }else
          {
             $product->featured=0;
          }
      }elseif ($request->type=="best_sale")
      {
        if ($product->best_sale==0) 
        {
          $product->best_sale=1;
        }else
        {
           $product->best_sale=0;
        }
      }elseif ($request->type=="hot") 
      {
        if ($product->hot==0) 
        {
          $product->hot=1;
        }else
        {
           $product->hot=0;
        }
      }elseif ($request->type=="top_sale") 
      {
        if ($product->top_sale==0) 
        {
          $product->top_sale=1;
        }else
        {
           $product->top_sale=0;
         }
      }elseif ($request->type=="big_save") 
      {
        if ($product->big_save==0) 
        {
          $product->big_save=1;
        }else
        {
           $product->big_save=0;
         }
      }elseif ($request->type=="new_arrival") 
      {
        if ($product->new_arrival==0) 
        {
          $product->new_arrival=1;
        }else
        {
           $product->new_arrival=0;
         }
      }elseif ($request->type=="trending") 
      {
        if ($product->trending==0) 
        {
          $product->trending=1;
        }else
        {
           $product->trending=0;
         }
      }

      $product->save();

      return \response()->json([
              'message' =>  trans('seller.item_updated'),
              'status_code' => 200
          ], Response::HTTP_OK);

    }
    

}
