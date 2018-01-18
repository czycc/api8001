<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 15)->comment('姓名');
            $table->string('phone',11)->comment('手机号');
            $table->string('postcode', 10)->comment('邮政编码');
//            $table->string('card',20)->comment('身份证号');
//            $table->text('path')->comment('身份证照片路径');
            $table->text('location')->comment('详细地址');
            $table->string('code', 10)->unique()->comment('兑奖码');
            $table->string('gift', 5);
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
        Schema::dropIfExists('orders');
    }
}
