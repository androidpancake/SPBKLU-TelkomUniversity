<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        //
    }
    public function create_admin()
    {
        return view('admin.create');
    }

    public function process_admin(Request $request)
    {

        $auth = app('firebase.auth');

        try {
            $userProperties = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone' => $request->input('phone'),
                'displayName' => $request->input('name')
            ];

            $user = $auth->createUserWithEmailAndPassword($userProperties['email'], $userProperties['password']);
            $uid = $user->uid;

            $customUserClaims = [
                'role' => 'admin'
            ];

            $auth->setCustomUserClaims($uid, $customUserClaims);

        } catch(FirebaseException $e) {
            Session::flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}
