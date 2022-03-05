<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use App\Models\Cart;

class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     public function showLoginForm()
    {
        if(Auth::check() && Auth::user()->user_type=="admin"){
                 return redirect()->route('admin.dashboard');
           }
        
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
      
        $user=User::where('email',$request->email)->first();

       if (!is_null($user)) {
          if ($user->is_active==1) {
            if (Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password])) {
                $user_type=Auth::user()->user_type;
                switch ($user_type) {
                    case 'admin':
                       // return redirect()->intended(route('admin.dashboard'));
                          $notification=['alert'=>'success','message'=>'Successfully login!!!','status'=>200,'route'=>route("admin.dashboard")];
                        break;
                        case 'seller':
                            $notification=['alert'=>'success','message'=>'Successfully login!!!','status'=>200,'route'=>route("seller.dashboard")];
                        break;
                    
                     default:
                           $carts=Cart::where('ip_address',$request->ip())->get();
                           if (!is_null($carts)) 
                           {
                              foreach ($carts as $cart) 
                              {
                                $cart->user_id=Auth::user()->id;
                                $cart->save();
                              }
                           }
                         $notification=['alert'=>'success','message'=>'Successfully login!!!','status'=>200,'route'=>route("customer.dashboard")];
                        break;
                }
               
            }else{
              $notification=['alert'=>'error','message'=>'Credential did not match','status'=>400,'route'=>null];
              
            }

          }else{
               $notification=['alert'=>'error','message'=>'You account is not active','status'=>402,'route'=>null];
                
          } 
       }else{
          $notification=['alert'=>'error','message'=>'No User is found for this email','status'=>404,'route'=>null];    
       }


       return json_encode($notification);  
    }


    public function logout(Request $request)
    {
        if(auth()->user() != null && (auth()->user()->user_type == 'admin')){
            $redirect_route = 'login';

        }elseif (auth()->user() != null && (auth()->user()->user_type == 'seller')) {
                                                                                       
           $redirect_route = 'seller.login';
        }
        else{
            $redirect_route = 'home.page';
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }
}
