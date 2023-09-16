<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\FirebaseException;
use Session;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $uid = Session::get('uid');

      try {
        $user = app('firebase.auth')->getUser($uid);

        if (!$user) {
            // User not found, redirect to login or handle the error accordingly
            return redirect()->route('login')->with('error', 'User not found. Please log in again.');
        }

        $verify = $user->emailVerified;

        if ($verify == 0) {
            return redirect()->route('verify');
        } else {
            return $next($request);
        }
      } catch (FirebaseException $e) {
          // Firebase exception occurred, handle the error accordingly
          return back()->with('error');
      }
      //   $verify = app('firebase.auth')->getUser($uid)->emailVerified;
    //     if ($verify == 0) {
    //       return redirect()->route('verify');
    //     }
    //     else{
    //     return $next($request);
    //  }
    }
}