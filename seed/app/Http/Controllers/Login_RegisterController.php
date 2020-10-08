<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class Login_RegisterController extends Controller
{
    public  function index()
    {
        return view('loginRegister/loginRegister');
    }

    public function create(array $data)
    {
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function register(Request $request)
    {
        request()->validate([
            'name'=>'required|min:3|max:17',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        $data =$request->all();
        $check = $this->create($data);
        //return response()->json($data,201);
        return redirect('/home')->withSucces('succesfull logged in');
    }
}
