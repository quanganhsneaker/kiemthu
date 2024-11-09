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
        Schema::table('contents', function (Blueprint $table) {
            $table->string('promotion_title')->nullable(); // Thêm cột promotion_title
            $table->string('company_title')->nullable(); // Thêm cột company_title nếu chưa có
            $table->string('promotion_description')->nullable(); // Thêm cột promotion_description nếu chưa có
            $table->string('company_description')->nullable(); // Thêm cột company_description nếu chưa có
            $table->string('return_policy')->nullable(); // Thêm cột return_policy nếu chưa có
            $table->string('feedback_text')->nullable(); // Thêm cột feedback_text nếu chưa có
        });
    }
    
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn([
                'promotion_title',
                'company_title',
                'promotion_description',
                'company_description',
                'return_policy',
                'feedback_text'
            ]);
        });
    }
    
};
