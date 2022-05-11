<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth; 
use Validator; 
use Redirect;
class AuthController extends Controller
{
    protected $redirectTo = admin_prefix.'/dashboard';
    protected $redirectBack = admin_prefix; 
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::guard(admin_guard)->user())  {   return Redirect::to($this->redirectTo);   }
        else   { $page_title= 'SSAP | Admin'; return view('backend::auth.login', compact('page_title'));}
    }

     /**
     * Login Action For Admin Users.
     * @param Request $request
     * @return Response
     */
    public function LoginAction(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $validator = Validator::make($request->all(), [  'email' => 'required',  'password' => 'required', ]);
            if($validator->fails()) {  return Redirect::back()->withErrors($validator);  }
            else
            {
                if (!$request->ajax()) 
                { 
                    // set the remember me cookie if the user check the box
                    $remember = ($request->exists('remember')) ? true : false;  
                    if (Auth::guard(admin_guard)->attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $remember)) 
                    { 
                        return Redirect::to($this->redirectTo); 
                    }
                    else { return Redirect::back()->withErrors(['message' => 'Invalid email or password. Try again!']);}
                } else { return response()->json(['message' => 'Page not found!'], 404);  }
            }
        }
        else{return Redirect::to($this->redirectBack);  }
    }
    
    /**
     * logout Admin
     * @return redirect
     */
    public function logout()
    { 
        Auth::guard(admin_guard)->logout();
        \Session::flush();
        return redirect($this->redirectBack);
    }
}
