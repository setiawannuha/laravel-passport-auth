<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function login(){
    return "Halaman Login";
  }
  public function register(){
    return "Halaman Register";
  }
  public function admin(){
    return "Halaman Admin";
  }
  public function user(){
    return "Halaman User";
  }
}
