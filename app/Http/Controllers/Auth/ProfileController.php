<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Contract\Auth;
use Kreait\Auth\Request\UpdateUser;
use Kreait\Firebase\Exception\FirebaseException;
use App\Http\Controllers\Controller;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Session;

class ProfileController extends Controller
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
    $uid = Session::get('uid');
    
    // dd($terms);
    try {
      $user = app('firebase.auth')->getUser($uid);
      // dd($user);
      if($user)
      {
        return view('profile.index',compact('user'));
      } else {
        return redirect()->route('login')->with('error', 'user not found');
      }
    } catch (FirebaseException $e) {
      return redirect()->route('login')->with('error', 'Error retrieving user data. Please log in again.');
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
    $id = Session::get('uid');
    
    $user = app('firebase.auth')->getUser($id);
    // dd($user->photoUrl);
    return view('profile.edit', compact('user'));
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
    $auth = app('firebase.auth');
    $database = app('firebase.database');

    $user = $auth->getUser($id);
    // dd($user);

    // $phoneNumberUtil = PhoneNumberUtil::getInstance();

    try {

      if ($request->new_password == '' && $request->new_confirm_password =='') {
        $request->validate([
          'displayName' => 'required|min:3|max:36',
          'phoneNumber' => 'max:12',
          'email' =>'required',
          'photo' => 'image'
        ]);
        
        // $phoneNumber = $phoneNumberUtil->parse($request->phoneNumber, 'ID');

        $properties = [
          'displayName' => $request->displayName,
          // 'phoneNumber' => $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164),
          'email' => $request->email,
          // 'photo' => $request->file('photo')
        ];

        if($request->hasFile('photo')){
          // $photo = $request->file('photo');
          // $photoName = 'profile/'.$id.'/'.time().'.'.$photo->getClientOriginalExtension();
          
          // // $serviceAccount = ServiceAccount::fromJsonFile('public/resources/credentials/firebase_credentials.json');
          // $firebase = (new Factory)
          //   ->withServiceAccount($serviceAccount)
          //   ->create();

          // $storage = $firebase->getStorage();
          // $bucket = $storage->getBucket();

          // $bucket->upload(
          //   file_get_contents($photo->getRealPath()),
          //   [
          //       'name' => $photoName
          //   ]
          // );

          // $photoUrl = 'https://storage.googleapis.com/' . $bucket->name() . '/' . $photoName;
          // $properties['photoUrl'] = $photoUrl;

          // $photoUrl = $bucket->object($photoName)->signedUrl(now()->addMinute(5));
          // $properties['photoUrl'] = $photoUrl;
          
          // $photoUrl = Storage::disk('gcs')->url($);
        }
        
        // dd($properties);
        $updatedUser = $auth->updateUser($id, $properties);

        if ($user->email != $request->email) {
          $auth->updateUser($id, ['emailVerified'=>false]);
        }

        Session::flash('message', 'Profile Updated');
        return back()->withInput();
      }
    } catch (FirebaseException $e) {
      Session::flash('error', $e->getMessage());
      return back()->withInput();
    }
  }

  public function update_password(Request $request, $id)
  {
    $auth = app('firebase.auth');
    $database = app('firebase.database');

    $user = $auth->getUser($id);
    try {
      $request->validate([
        'new_password' => 'required|max:18|min:8',
        'new_confirm_password' => 'same:new_password',
      ]);
      $updatedUser = $auth->changeUserPassword($id, $request->new_password);

      Session::flash('message', 'Password Updated');
      return back()->withInput();
    } catch(FirebaseException $e)
    {
      Session::flash('error', $e->getMessage());
      return back()->withInput();
    }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $updatedUser = app('firebase.auth')->disableUser($id);
    Session::flush();
    return redirect('/login');
  }

  public function terms()
  {
    $database = app('firebase.database');
    $terms = $database->getReference('terms')->getValue();
    // dd($terms);
    return view('terms.terms', compact('terms'));
  }
}
