<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBinariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->integer('position');
            $table->text('path', 12288)->nullable();
            $table->integer('level')->nullable();
            $table->timestamps();
        });

        DB::table('binaries')->insert([
            'id'        => 1,
            'parent_id' => 0,
            'position'  => 0,
            'path'      => '1',
            'level'    => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binaries');
    }
}
