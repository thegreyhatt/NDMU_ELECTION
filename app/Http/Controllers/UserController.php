<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\support\facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::all()->first();
        return view('admin/user', compact('user'));
    }

    public function newEmail(Request $request)
    {
        $user = Auth::user();
        $newEmail = $request->email;
        $currentPassword = $request->currentPassword;

        if(Hash::check($currentPassword, $user->password)){
            $objuser = User::find(Auth::user()->id);
            $objuser->email = $newEmail;
            $objuser->save();
            return back();
        }else{
            return back();
        }
    }

    public function newPassword(Request $request)
    {
        $user = Auth::user();
        $newPass = $request->newPassword;
        $currentPassword = $request->currentPassword;
        $PasswordConfirmation = $request->passwordConfirmation;

        if(Hash::check($currentPassword, $user->password)){
            $objuser = User::find(Auth::user()->id);
            $objuser->password = Hash::make($newPass);
            $objuser->save();
            return redirect()->route('indexAdmin')->with('message', 'Change password success');
        }else{
            return redirect()->route('indexAdmin')->with('error', 'Change password failed');
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
