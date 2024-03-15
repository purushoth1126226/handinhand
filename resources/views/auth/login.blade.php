<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="shortcut icon" href="{{ asset('img/fav.png')}}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<!-- component -->

<body class="bg-blue-100 font-sans leading-normal tracking-normal">
    @include('sweetalert::alert')
    <!-- Container -->
    <div class="container mx-auto">
        <div class="flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <!-- <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg" style="background-image: url('https://source.unsplash.com/random/600x800')"></div> -->
                <!-- Col -->
                <div class="w-full mx-auto lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">{{ __('Login') }}</h3>
                    <form method="POST" action="{{ route('login') }}" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                {{ __('E-Mail Address') }}
                            </label>
                            <input id="email" type="email" class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                            <span class="text-xs italic text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror



                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                {{ __('Password') }}
                            </label>

                            <input name="password" id="password" type="password" class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"  autocomplete="password">

                            @error('password')
                            <span class="text-xs italic text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror


                        </div>
                        <div class="mb-4">
                            <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="text-sm" for="remember_id">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="mb-6 text-center">
                            <button class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                        {{-- <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="./register.html"
                            >
                                Create an Account!
                            </a>
                        </div>
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="./forgot-password.html"
                            >
                                Forgot Password?
                            </a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



</html>