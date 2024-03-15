<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_full_name')->nullable();
            $table->string('company_iso')->nullable();

            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('address_three')->nullable();
            $table->string('address_four')->nullable(); // optional
            $table->string('landline')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('websitetheme')->nullable();
            $table->integer('blogtemplates')->default(0);

            // $table->string('bank_name')->nullable();
            // $table->string('account_number')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('branch')->nullable();

            $table->string('theme_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('background_color')->nullable();

            $table->string('uplode_logo_image')->nullable();
            $table->string('favicon_image')->nullable();

            $table->string('headerbg_color')->nullable();
            $table->string('headertext_color')->nullable();
            $table->string('footerbg_color')->nullable();
            $table->string('footertext_color')->nullable();

            // $table->string('gateway_url')->nullable();
            // $table->string('gateway_key')->nullable();
            // $table->string('gateway_token')->nullable();
            // $table->text('map_code')->nullable();

            $table->string('email_from_name')->nullable();
            $table->string('email_from_mail')->nullable();
            $table->string('email_mail_driver')->nullable();
            $table->string('email_mail_host')->nullable();
            $table->string('email_mail_port')->nullable();
            $table->string('email_mail_username')->nullable();
            $table->string('email_mail_password')->nullable();
            $table->string('email_mail_encryption')->nullable();

            // $table->string('facebook')->nullable();
            // $table->string('twitter')->nullable();
            // $table->string('instagram')->nullable();
            // $table->string('linkedin')->nullable();
            // $table->string('youtube')->nullable();

            // $table->string('keyword')->nullable();
            // $table->text('description')->nullable();

            $table->string('copyrights')->nullable();
            $table->string('timezone')->nullable();
            $table->string('dateformate')->nullable();
            $table->string('dateformat_javascript')->nullable();

            // $table->boolean('mailchimpflag')->default(false);
            // $table->string('mailchimpapikey')->nullable();
            // $table->string('mailchimplistid')->nullable();

            $table->boolean('recaptchasecretstatus')->default(false);
            $table->string('recaptchasecretkey')->nullable();
            $table->string('recaptchasitekey')->nullable();

            // $table->boolean('disqusflag')->default(false);
            // $table->text('disquscode')->nullable();

            // $table->string('googleanalyticsapi')->nullable();
            // $table->text('googleanalyticscode')->nullable();

            // $table->text('googleadsverticalcode')->nullable();
            // $table->text('googleadshorizontalcode')->nullable();

            // $table->integer('searchstatus')->default(1);
            // $table->string('algoliaapp')->nullable();
            // $table->string('algoliasecret')->nullable();

            // $table->text('socialmediaicon')->nullable(); //addthid

            $table->integer('flag')->default(0);
            $table->integer('active_status')->default(0);
            $table->string('updated_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('remarks')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
