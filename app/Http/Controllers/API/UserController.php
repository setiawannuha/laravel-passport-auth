<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function register(Request $request){
      $input = $request->all();
      $input['password'] = bcrypt($input['password']);
      $user = User::create($input);
      $scope = $request->level == "1" ? ["admin"] : ["user"];
      $success['token'] =  $user->createToken('HelloWorld', $scope)->accessToken;
      $success['name'] =  $user->name;

      return response()->json(['success'=>$success], 200);
    }

    public function login(Request $request){
      if(
        Auth::attempt(
          [
            'email' => $request->email, 
            'password' => $request->password
          ]
        )
      ){
        $user = Auth::user();
        $scope = $request->level == "1" ? ["admin"] : ["user"];
        $success['token'] =  $user->createToken('HelloWorld', $scope)->accessToken;
        return response()->json(['success' => $success], 200);
      } 
      else{
        return response()->json(['error'=>'Unauthorised'], 401);
      }
    }
    public function logout(Request $request)
    {
      $user = Auth::user()->token();
      $user->revoke();
      return "Logout";
    }
    
    public function loginPage(){
      return "You must Login";
    }
    public function detailUser(Request $request){
      $user = Auth::user();
      var_dump("User");
      return response()->json(['success' => $user], 200);
    }
}
