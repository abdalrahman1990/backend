<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserManagement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        auth()->setDefaultDriver('api');
    }

    public function verifyUserLogin(Request $request){
        $email = request('email');
        $password = request('password');
        $credentials = array('email' => $email, 'password' => $password);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['status'=> 'fail', 'message'=>'User not found']);
        }else{
            return response()->json(['status'=> 'success', 'message'=>'User logedin', 'userinfo'=>Auth::user(), 'token'=>$token]);
        }
    }

    public function logoutUser(Request $request){
        auth()->logout();
        return response()->json(['status'=> 'success', 'message' => 'Successfully logged out']);
    }

    public function viewUser(Request $request) {
        $data['id'] = auth()->user()->id;
        $data['name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;
        $data['city'] = auth()->user()->city;
        $data['age'] = auth()->user()->age;


        return response()->json(['status'=> 'success', 'userdata' => $data]);
    }

    public function resgisterUser(Request $request){
        //return auth()->user();
        if(empty(auth()->user())){
            $name = $request->name;
            $email = $request->email;
            $password = Hash::make($request->password);
            $city = $request->city;
            $age = $request->age;
            $token = $request->token;

            $data = array('name'=>$name,'email'=> $email,'password'=> $password,'city'=> $city,'age'=> $age);
            $db = new UserManagement();
            $db->registerNewUser($data);
            $response = array('status'=> 'success', 'message'=>'user added succesfully');
        }else{
            $response = array('status'=> 'fail', 'message'=>'Logedin user can not register new user.');
        }

        return json_encode($response);
    }

    // public function resgisterUser(Request $request){
    //     if(Auth::check()){
    //         $response = array('status'=> 'fail', 'message'=>'Logedin user can not register new user.');
    //     }else{
    //         $name = $request->name;
    //         $email = $request->email;
    //         $password = Hash::make($request->password);
    //         $city = $request->city;
    //         $age = $request->age;
    //         $token = $request->token;

    //         $data = array('name'=>$name,'email'=> $email,'password'=> $password,'city'=> $city,'age'=> $age);
    //         $db = new UserManagement();
    //         $db->registerNewUser($data);
    //         $response = array('status'=> 'success', 'message'=>'user added succesfully');
    //     }
    //     return json_encode($response);
    // }

    public function test(Request $request){
        if(Auth::check()){
            return json_encode(['msg'=>Auth::user()]);
        }else{
            return json_encode(['msg'=>'User not loged in']);
        }
    }



}
