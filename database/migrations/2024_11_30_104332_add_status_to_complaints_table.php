<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->boolean('status')->default(0); // 0: chưa xác nhận, 1: đã xác nhận
        });
    }
    
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
};
