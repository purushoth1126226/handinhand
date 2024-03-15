<!-- https://www.5balloons.info/two-factor-authentication-google2fa-laravel-5/ -->
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
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
<body class="bg-gray-100">

      <div class="px-10 py-6">
         <div class="shadow p-3 bg-white rounded">
            <div class="text-3xl mb-4">Two Factor Authentication</div>
            <div class="panel-body">
               <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>
               @if (session('error'))
               <div class="text-red-500">
                  {{ session('error') }}
               </div>
               @endif
               @if (session('success'))
               <div class="text-success-500">
                  {{ session('success') }}
               </div>
               @endif
               <strong>Enter the pin from Google Authenticator Enable 2FA</strong><br/><br/>
               <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="m-2 {{ $errors->has('one_time_password-code') ? ' "text-red-500' : '' }}">
                     <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>
                     <div class="col-md-6">
                        <input name="one_time_password" class="p-1 border rounded border-gray-400"  type="text"/>
                     </div>
                  </div>
                  <div class="mt-2">
                     <div class="col-md-6 col-md-offset-4">
                        <button class="ml-4 p-2 bg-green-500 hover:bg-green-600 rounded shadow  text-white" type="submit">Authenticate</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
</body>



</html>