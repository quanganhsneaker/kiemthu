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
        Schema::table('messages', function (Blueprint $table) {
            $table->tinyInteger('is_read')->default(0); // Thêm cột is_read với giá trị mặc định là 0
        });
    }
    
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('is_read'); // Xóa cột is_read khi rollback
        });
    }
    
};
