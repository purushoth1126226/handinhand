<?php

namespace Database\Seeders;

use App\Models\Admin\Settings\configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        configuration::create([
            'uuid' => '88fc5a4d-8283-478b-aba2-8queens',
            'company_name' => "Laravel Classic Blog",
            'company_full_name' => "Laravel Classic Blog",
            'company_iso' => 'ACGPC0488A',

            'address_one' => '2867  Patterson Street, ',
            'address_two' => 'WEST HARWICH, Massachusetts',
            'address_three' => '02671',
            'landline' => '713-253-1681',
            'phone' => '713-253-1681',
            'email' => 'webtoolcollection@gmail.com',
            'website' => 'https://www.webtoolscollection.com/',

            'theme_color' => 'bg-green-500',
            'text_color' => 'text-white',
            'background_color' => 'bg-green-50',

            'headerbg_color' => 'bg-white',
            'headertext_color' => 'text-gray-800',
            'footerbg_color' => 'bg-gray-100',
            'footertext_color' => 'text-gray-800',

            // 'uplode_logo_image' => '',
            // 'favicon_image' => '',
            // 'disqusflag' => true,
            // 'disquscode' => '<div id="disqus_thread"></div>
            // <script>(function() { // DONT EDIT BELOW THIS LINE
            // var d = document, s = d.createElement("script");
            // s.src = "https://mindchirps.disqus.com/embed.js";
            // s.setAttribute("data-timestamp", +new Date());
            // (d.head || d.body).appendChild(s);
            // })();
            // </script>
            // <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>',

            "email_from_name" => 'System Admin',
            "email_from_mail" => 'systemadmin@gmail.com',
            "email_mail_driver" => 'smtp',
            "email_mail_host" => 'smtp.gmail.com',
            "email_mail_port" => '587',
            "email_mail_username" => 'systemadmin@gmail.com',
            "email_mail_password" => '',
            "email_mail_encryption" => 'tls',

            // 'facebook' => 'https://www.facebook.com/',
            // 'twitter' => 'https://twitter.com/',
            // 'instagram' => 'https://www.instagram.com/',
            // 'linkedin' => 'https://www.linkedin.com/',
            // 'youtube' => 'https://www.youtube.com/',

            // 'googleanalyticsapi' => 'xyz',
            // 'googleanalyticscode' => '<!-- Global Site Tag (gtag.js) - Google Analytics -->',

            'copyrights' => '© Copyright 2021. All Rights Reserved.',
            'timezone' => 'America/New_York',
            'dateformate' => 'd/m/Y',
            'dateformat_javascript' => 'd/m/Y',

            // 'mailchimpflag' => true,
            // 'mailchimpapikey' => 'xyz',
            // 'mailchimplistid' => 'xyz',

            // 'googleadsverticalcode' => '',
            // 'googleadshorizontalcode' => '',

            'recaptchasecretstatus' => false,
            'recaptchasitekey' => 'your_site_key',
            'recaptchasecretkey' => 'your_secret_key',

            // 'socialmediaicon' => '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cf1e590ca138275"></script>',

        ]);

        // Aboutme::create([
        //     'uuid' => '88fc5a4d-1221-478b-aba2-blogwebtool',
        //     'title' => 'About Me',
        //     'avatartaglineone' => 'John Doe',
        //     'avatartaglinetwo' => 'Blogger',
        //     'avatar' => '',
        //     'avataractive' => 1,
        //     'body' => "Hello! I am John Doe and this is my small corner of the internet where I share my life, my style (consisting mostly of slow fashion, secondhand items, and ethical brands), and anything else that I'm interested in. Almost all reviews here are unsponsored and unbiased (or at least I try to be). I hope you find something useful here and thanks for reading!",
        //     'active' => 1,
        //     'avataractive' => 1,
        // ]);

    }
}
