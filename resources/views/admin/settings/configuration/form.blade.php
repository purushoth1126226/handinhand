
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "company_name", 'name' => __('label.config_name_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('company_name',$configuration->company_name ,array('id'=>'company_name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "company_name"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "company_full_name", 'name' => __('label.config_fullname_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('company_full_name',$configuration->company_full_name ,array('id'=>'company_full_name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "company_full_name"])
    </div>
</div>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "website", 'name' =>  __('label.config_website_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('website',$configuration->website ,array('id'=>'website', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "website"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "uplode_logo_image", 'name' =>  __('label.config_uploadlogo_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      <input type="file" name="uplode_logo_image"  accept="image/*" id="uplode_logo_image" class="form-input rounded block w-full p-1 focus:bg-white">
       @include('helper.formerror', ['error' => "uplode_logo_image"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "favicon_image", 'name' =>  __('label.config_favicon_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      <input type="file" name="favicon_image"  accept="image/*" id="favicon_image" class="form-input rounded block w-full p-1 focus:bg-white">
      @include('helper.formerror', ['error' => "favicon_image"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "theme_color", 'name' =>  __('label.config_theme_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
       {{ Form::select('theme_color', $themecolor, $configuration->theme_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "theme_color"])
    </div>
</div>



<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "text_color", 'name' => __('label.config_textcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('text_color', $textcolor, $configuration->text_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "text_color"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "background_color", 'name' => __('label.config_bgcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('background_color', $themecolor, $configuration->background_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "background_color"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "headerbg_color", 'name' => __('label.config_headerbgcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('headerbg_color', $themecolor, $configuration->headerbg_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "headerbg_color"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "headertext_color", 'name' => __('label.config_headertextcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('headertext_color', $textcolor, $configuration->headertext_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "headertext_color"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "footerbg_color", 'name' => __('label.config_footerbgcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('footerbg_color', $themecolor, $configuration->footerbg_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "footerbg_color"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "footertext_color", 'name' =>  __('label.config_footertextcolor_edit'), 'required' => true])
    </div>
    <div class="md:w-4/12">
      {{ Form::select('footertext_color', $textcolor, $configuration->footertext_color, array('class' => 'form-input rounded block w-full p-1 focus:bg-white', 'readonly' => 'true')) }}
       @include('helper.formerror', ['error' => "footertext_color"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "timezone", 'name' => __('label.config_timezone_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('timezone',$configuration->timezone ,array('id'=>'timezone', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "timezone"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "dateformate", 'name' => __('label.config_dateformate_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::text('dateformate',$configuration->dateformate ,array('id'=>'dateformate', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "dateformate"])
    </div>
</div>

<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "copyrights", 'name' => __('label.config_copyright_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::text('copyrights',$configuration->copyrights ,array('id'=>'copyrights', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "copyrights"])
    </div>
    <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "remarks", 'name' => __('label.config_remark_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::textarea('remarks',$configuration->remarks ,array('id'=>'', 'class'=>'form-textarea rounded block w-full focus:bg-white', 'rows'=>'2')) }}
       @include('helper.formerror', ['error' => "remarks"])
    </div>
</div>



<p class="text-xl p-2 flex items-center bg-blue-200 mb-6">
    <i class="fas fa-list mr-3"></i> {{ __('label.config_mailcredentials_edit')}}
</p>





<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_from_name", 'name' => __('label.config_fromname_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_from_name',$configuration->email_from_name ,array('id'=>'email_from_name', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_from_name"])
    </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_from_mail", 'name' => __('label.config_fromemail_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_from_mail',$configuration->email_from_mail ,array('id'=>'email_from_mail', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_from_mail"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_driver", 'name' => __('label.config_maildriver_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_driver',$configuration->email_mail_driver ,array('id'=>'email_mail_driver', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_driver"])
    </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_host", 'name' => __('label.config_mailhost_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_host',$configuration->email_mail_host ,array('id'=>'email_mail_host', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_host"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_port", 'name' => __('label.config_mailport_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_port',$configuration->email_mail_port ,array('id'=>'email_mail_port', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_port"])
    </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_username", 'name' => __('label.config_mailusername_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_username',$configuration->email_mail_username ,array('id'=>'email_mail_username', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_username"])
    </div>
</div>


<div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_password", 'name' =>__('label.config_mailpassword_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_password',$configuration->email_mail_password ,array('id'=>'email_mail_password', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_password"])
    </div>
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "email_mail_encryption", 'name' => __('label.config_mailencription_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
       {{ Form::text('email_mail_encryption',$configuration->email_mail_encryption ,array('id'=>'email_mail_encryption', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "email_mail_encryption"])
    </div>
</div>


<p class="text-xl p-2 flex items-center bg-blue-200 mb-6">
   <i class="fas fa-list mr-3"></i> {{__('label.config_googlecaptcha_edit')}}
 </p>




 <div class="md:flex mb-3">
    <div class="md:w-2/12">
       @include('helper.formlabel', ['for' => "recaptchasecretstatus", 'name' => __('label.config_captchastatus_edit'), 'required' => false])
     </div>
     <div class="md:w-4/12">
       {{ Form::select('recaptchasecretstatus', ['DISABLE', 'ENABLE'], $configuration->recaptchasecretstatus, ['class' => 'form-select rounded block w-full focus:bg-white  p-1']) }}
        @include('helper.formerror', ['error' => "recaptchasecretstatus"])
     </div>

     <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "recaptchasitekey", 'name' => __('label.config_captchasite_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::text('recaptchasitekey',$configuration->recaptchasitekey ,array('id'=>'recaptchasitekey', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "recaptchasitekey"])
    </div>
 </div>


 <div class="md:flex mb-3">
   <div class="md:w-2/12">
      @include('helper.formlabel', ['for' => "recaptchasecretkey", 'name' => __('label.config_captchasecret_edit'), 'required' => false])
    </div>
    <div class="md:w-4/12">
      {{ Form::text('recaptchasecretkey',$configuration->recaptchasecretkey ,array('id'=>'recaptchasecretkey', 'class'=>'form-input rounded block w-full p-1 focus:bg-white')) }}
       @include('helper.formerror', ['error' => "recaptchasecretkey"])
    </div>
</div>
