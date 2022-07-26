<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_detail', function (Blueprint $table) {
            $table->id();
            $table->string('mcusdoc',100);
            $table->string('mcustno',100);
            $table->string('mcustname',100);
            $table->string('send_from',100);
            $table->string('fax',100);
            $table->string('email',100);
            $table->string('report',100);
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
        Schema::dropIfExists('send_detail');
    }
}
