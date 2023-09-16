<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Session;

class RegisterController extends Controller
{
   /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

   use RegistersUsers;
   protected $auth;

   /**
    * Where to redirect users after registration.
    *
    * @var string
    */
   protected $redirectTo = RouteServiceProvider::HOME;
   
   public function __construct(FirebaseAuth $auth) {
      $this->middleware('guest');
      $this->auth = $auth;
   }

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'name' => ['required', 'string', 'max:255'],
         'phone' => ['required','string', 'max:12'],
         'email' => ['required', 'string', 'email', 'max:255'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ], [
         'phone.max' => 'Nomor telepon harus maksimal :max digit',
         'email.unique' => 'Email sudah digunakan',
         'password.min' => 'Password harus memiliki minimal :min karakter',
         'password.confirmed' => 'Konfirmasi password tidak sesuai',
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Models\User
    */
   protected function register(Request $request) {

      $phoneNumberUtil = PhoneNumberUtil::getInstance();

      try {
         $phoneNumber = $phoneNumberUtil->parse($request->input('phone'), 'ID');

         $this->validator($request->all())->validate();
         $userProperties = [
            'email' => $request->input('email'),
            'emailVerified' => false,
            'phoneNumber' => $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164),
            'password' => $request->input('password'),
            'displayName' => $request->input('name'),
            'disabled' => false
         ];
         $createdUser = $this->auth->createUser($userProperties);
         // dd($createdUser);
         return redirect()->route('login');
      } catch (FirebaseException $e) {
         Session::flash('error', $e->getMessage());
         return back()->withInput()->withErrors(['registration_error' => $e->getMessage()]);
      }
   }

   public function admin_register()
   {
      return view('admin.create');
   }

   protected function process_admin(Request $request)
   {

      $auth = app('firebase.auth');

      try {
         $userProperties = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
         ];

         $user = $auth->createUserWithEmailAndPassword($userProperties['email'], $userProperties['password']);
         $uid = $user->uid;

         $customUserAttribute = [
            'role' => 'adnin'
         ];

         $auth->setCustomUserAttributes($uid, $customUserAttribute);

      } catch(FirebaseException $e) {
         Session::flash('error', $e->getMessage());
         return back()->withInput();
      }
   }
}
