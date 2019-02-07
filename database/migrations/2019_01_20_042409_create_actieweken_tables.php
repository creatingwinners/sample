<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiewekenTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->incrementss('id');
            $table->string('ipaddress');
            $table->timestamps();
        });

        Schema::create('acties', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(false);
            $table->string('name');
            $table->integer('ip_limit')->default(1);
            $table->integer('ip_limit_duration')->default(5);
            $table->integer('ratio_win')->default(1);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->timestamps();
        });

        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actie_id')->unsigned();
            $table->string('name');
            $table->string('short');
            $table->enum('coupon', ['book', 'diner'])->nullable()->default(null);
            $table->enum('type', ['day', 'month'])->default('day');
            $table->integer('quantity')->default(1);

            $table->timestamps();

            $table->foreign('actie_id')->references('id')->on('acties');
        });

        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon')->unique();
            $table->enum('type', ['book', 'diner']);
            $table->timestamps();
        });

        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actie_id')->unsigned();
            $table->integer('price_id')->unsigned()->nullable();
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->integer('participant_id')->unsigned()->nullable();
            $table->string('code')->unique();

            $table->string('cardnumber')->nullable();
            $table->string('naam')->nullable();
            $table->string('adres')->nullable();
            $table->string('huisnummer')->nullable();
            $table->string('postcode')->nullable();
            $table->string('woonplaats')->nullable();

            $table->string('ipaddress')->nullable();

            $table->timestamps();

            $table->foreign('actie_id')->references('id')->on('acties');
            $table->foreign('price_id')->references('id')->on('prices');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('participant_id')->references('id')->on('participants');
        });

        Schema::create('monthprices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id')->unsigned();
            $table->string('start');
            $table->string('end');

            $table->timestamps();

            $table->foreign('voucher_id')->references('id')->on('vouchers');
        });

        Schema::create('actie_monthprice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monthprice_id')->unsigned();
            $table->integer('actie_id')->unsigned();

            $table->timestamps();

            $table->foreign('monthprice_id')->references('id')->on('monthprices');
            $table->foreign('actie_id')->references('id')->on('acties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('logs');
        Schema::drop('monthprices');
        Schema::drop('actie_monthprice');
        Schema::drop('acties');
        Schema::drop('prices');
        Schema::drop('coupons');
        Schema::drop('participants');
        Schema::drop('vouchers');
        Schema::enableForeignKeyConstraints();
    }
}
