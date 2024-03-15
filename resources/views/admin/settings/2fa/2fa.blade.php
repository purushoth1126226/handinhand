@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.admincreateoreditnav name=user title="{{ __('label.twofa_title')}}" :obj="Auth::user()" backbutton="adminsettings" />

    <div class="px-10 py-6 ">
         <div class="shadow p-3 bg-white rounded">
            <div class="text-3xl mb-4"><strong>Two Factor Authentication</strong></div>
            <div class="mb-4">
               <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>
               <br/>
               <p class="mb-4">To Enable Two Factor Authentication on your Account, you need to do following steps</p>
               <strong>
                  <ol>
                     <li>1 .Click on Generate Secret Button , To Generate a Unique secret QR code for your profile</li>
                     <li>2. Verify the OTP from Google Authenticator Mobile App</li>
                  </ol>
               </strong>
               <br/>
               @if (session('error'))
               <div class="text-red-500 text-lg">
                  {{ session('error') }}
               </div>
               @endif
               @if (session('success'))
               <div class="text-green-500 text-lg">
                  {{ session('success') }}
               </div>
               @endif
               @if(!($data['user']->passwordSecurity))
               <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="p-2 bg-blue-500 text-white hover:bg-blue-600 rounded">
                        Generate Secret Key to Enable 2FA
                        </button>
                     </div>
                  </div>
               </form>
               @elseif(!$data['user']->passwordSecurity->google2fa_enable)
               <strong>1. Scan this barcode with your Google Authenticator App:</strong><br/>
               <img class="shadow p-2 ml-5" src="{{$data['google2fa_url'] }}" alt="">
               <br/><br/>
               <strong>2.Enter the pin the code to Enable 2FA</strong><br/><br/>
               <form class="ml-6" method="POST" action="{{ route('enable2fa') }}">
                  {{ csrf_field() }}
                  <div class="{{ $errors->has('verify-code') ? ' text-red-500' : '' }}">
                     <label for="verify-code" class="col-md-4 control-label">Authenticator Code</label>
                     <div class="col-md-6">
                        <input id="verify-code" type="password" class="p-1 border rounded border-gray-400 " name="verify-code" required>
                        @if ($errors->has('verify-code'))
                        <span class="text-red-500">
                        <strong>{{ $errors->first('verify-code') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                     <div class="p-4">
                        <button type="submit" class="p-2 bg-green-500 hover:bg-green-600 rounded shadow  text-white">
                        Enable 2FA
                        </button>
                     </div>
               </form>
               @elseif($data['user']->passwordSecurity->google2fa_enable)
               <div class="alert alert-success">
                  2FA is Currently <strong>Enabled</strong> for your account.
               </div>
               <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>
               <form class="ml-6 mt-4" method="POST" action="{{ route('disable2fa') }}">
                  <div class="form-group{{ $errors->has('current-password') ? ' text-red-500' : '' }}">
                     <label for="change-password" class="">Current Password</label>
                     <div class="col-md-6">
                        <input id="current-password" type="password" class="p-1 border rounded border-gray-400" name="current-password" required>
                        @if ($errors->has('current-password'))
                        <span class="text-red-500">
                        <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="p-4">
                     {{ csrf_field() }}
                     <button type="submit" class="p-2 bg-red-500 hover:bg-red-600 rounded shadow  text-white">Disable 2FA</button>
                  </div>
               </form>
               @endif
               </form>
            </div>
   </div>
</div>
@endsection
@section('footerSection')
@endsection
