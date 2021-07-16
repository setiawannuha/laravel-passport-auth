<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function register(Request $request){
      $input = $request->all();
      $input['password'] = bcrypt($input['password']);
      $admin = Admin::create($input);
      $success['token'] =  $admin->createToken('NamaAplikasiPassword')->accessToken;
      $success['name'] =  $admin->name;

      return response()->json(['success'=>$success], 200);
    }
    public function login(Request $request){
      $credentials = ['email' => $request->email, 'password' => $request->password];
      if(
        Auth::guard('admin')->attempt($credentials)
      ){
        $admin = Auth::guard('admin')->admin();
        $success['token'] =  $admin->createToken('nAppAdmin')->accessToken;
        return response()->json(['success' => $success], 200);
      } 
      else{
        return response()->json(['error'=>'Unauthorised'], 401);
      }
    }
}
