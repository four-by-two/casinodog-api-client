<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wainwright_operator_disabled_games', function (Blueprint $table) {
            $table->id('id')->index();
            $table->string('gid', 100);
            $table->string('extra', 100);
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
        Schema::dropIfExists('wainwright_operator_disabled_games');
    }
};
