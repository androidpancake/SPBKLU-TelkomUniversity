@extends('layouts.auth')

@section('content')
<h1 class="font-medium text-xl mb-2">Login</h1>
<div class="flex flex-col justify-between">
  <div>
      <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email" required>
        @error('email')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="password" required>
        @error('password')
            <span class="" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <a href="/password/reset" class="flex justify-end text-green-400 hover:underline">Lupa password</a>

      <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
          <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
          <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="remember">
              {{ __('Remember Me') }}
          </label>
        </div>
      </div>
      <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
    </form>
    <div class="inline-flex mt-4 space-x-1">
        <p class="text-base dark:text-white">Belum punya akun?</p>
        <a href="{{ route('register') }}" class="text-green-600 hover:underline dark:text-blue-400">Daftar</a>
    </div>
  </div>
  <div class="align-bottom mt-8 text-center">
    <a href="/terms-condition">Syarat dan Ketentuan</a>
  </div>
</div>



<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
// Initialize Firebase
var firebaseConfig = {
  apiKey: "AIzaSyBk0Plf2Fs-X73P5lEuysrCuaBgY2W84Eo",
  authDomain: "spbklu2.firebaseapp.com",
  databaseURL: "https://spbklu2-default-rtdb.firebaseio.com",
  projectId: "spbklu2",
  storageBucket: "spbklu2.appspot.com",
  messagingSenderId: "1033479220803",
  appId: "1:1033479220803:web:cb045467b4c9cbf103aef6",
  measurementId: "G-M7T4WZV1MK"
};
firebase.initializeApp(config);
// var facebookProvider = new firebase.auth.FacebookAuthProvider();
// var googleProvider = new firebase.auth.GoogleAuthProvider();
// var facebookCallbackLink = '/login/facebook/callback';
// var googleCallbackLink = '/login/google/callback';
// async function socialSignin(provider) {
//   var socialProvider = null;
//   if (provider == "facebook") {
//     socialProvider = facebookProvider;
//     document.getElementById('social-login-form').action = facebookCallbackLink;
//   } else if (provider == "google") {
//     socialProvider = googleProvider;
//     document.getElementById('social-login-form').action = googleCallbackLink;
//   } else {
//     return;
//   }
//   firebase.auth().signInWithPopup(socialProvider).then(function(result) {
//     result.user.getIdToken().then(function(result) {
//       document.getElementById('social-login-tokenId').value = result;
//       document.getElementById('social-login-form').submit();
//     });
//   }).catch(function(error) {
//     // do error handling
//     console.log(error);
//   });
// }
</script>

@endsection
