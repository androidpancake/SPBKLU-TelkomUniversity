<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>SPBKLU</title>
</head>
<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between p-4 md:space-y-2">
            <a href="#" class="flex items-center">
                <img src="{{ asset('storage/image/judul.png') }}" class="h-8 mr-3" alt="Flowbite Logo" />
            </a>
            <div class="flex items-center md:order-2">
                @if(Route::has('login'))
                    @auth
                    <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                        <span id="displayName" class="block text-sm text-gray-900 dark:text-white">{{ $user->displayName }}</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profil</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex justify-start px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</button>
                            </form>
                        </li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('home') }}" class="font-base text-white px-3 py-3 bg-green-600 rounded-lg">Ke Aplikasi</a>
                    </div>
                    @else
                    <div class="space-y-4 md:space-y-4">
                        <a href="{{ route('register') }}" class="font-base text-white px-3 py-3 bg-green-600 rounded-lg">Sign up</a>
                        <a href="{{ route('login') }}" class="font-base px-3 py-4">Login</a>
                    </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl text-start xl:text-6xl dark:text-white">Tukar baterai anda dengan mudah</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Kami menyediakan layanan penukaran baterai untuk kendaraan listrik anda.</p>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
            </div>                
        </div>
    </section>

<script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
import { getAuth } from "firebase/auth";
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

document.addEventListener("DOMContentLoad", function(){
    const auth = getAuth();
    const user = auth.currentUser;

    if(user !== null)
    {
        const displayName = user.displayName;
        console.log(displayName);
        document.getElementById("displayName").textContent = displayName;
        const email = user.email;
        const phoneNumber = user.phoneNumber;
        const photoURL = user.photoURL;
        const emailVerified = user.emailVerified;
    }
});
    
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
</body>
</html>