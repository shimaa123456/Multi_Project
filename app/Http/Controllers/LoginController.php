<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyLogin(Request $request){
        //
        $loginUser = Login::where("loginName", "=", $request->loginName)->first();
        if($loginUser){
             if (Hash::check($request->password, $loginUser->password)) {
          // if ($request->password == $loginUser->password) {
                //token
                    $loginToken = Hash::make(time() . $loginUser->id);
                    $loginUser->token = $loginToken;
                    $loginUser->save();
                //session
                    Session::put('loginToken', $loginToken);
                //redirect
                    return redirect('admin/mainBanner');
            }
            else{
                return redirect('login')
                            ->with('failed','Bad user name or password');
            }
        }
        else{
            return redirect('login')
                            ->with('failed','Bad user name or password');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if(Session::has('loginToken')){
            $sessionToken = Session::get('loginToken');
            $loginUser = Login::where("token", "=", $sessionToken)->first();
            $loginUser->token = "0";
            $loginUser->save();
            Session::flush();
        }

        ////////////////////////////
        return redirect('login')->with('logout','You Logged out !!!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        $sessionToken = Session::get('loginToken');
        $loginUser = Login::where("token", "=", $sessionToken)->first();
        $role = $loginUser->role;

        return view('admin/changePassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmNewPassword' => 'required',
        ]);

        $sessionToken = Session::get('loginToken');
        $loginUser = Login::where("token", "=", $sessionToken)->first();
         if(Hash::check($request->oldPassword, $loginUser->password)){
        // if($request->oldPassword == $loginUser->password){
            if($request->newPassword === $request->confirmNewPassword){
                $loginUser->password = bcrypt($request->newPassword);
                $loginUser->save();
                return redirect()->action('App\Http\Controllers\LoginController@logout');
            }
            else{
                return redirect()->back()->with('failed', 'New and Confirmed Password are not Matched');
            }
        }
        else{
            return redirect()->back()->with('failed', 'Old Password not Matched');
        }
    }

}