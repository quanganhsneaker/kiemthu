<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryToProductsTable extends Migration
{
    /**
     * Thực thi migration để thêm cột.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Thêm cột 'category' sau cột 'name'
            $table->string('category')->after('name');
        });
    }

    /**
     * Rollback migration để xóa cột.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Xóa cột 'category'
            $table->dropColumn('category');
        });
    }
}
