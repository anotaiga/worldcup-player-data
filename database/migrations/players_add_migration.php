<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::table('players', function (Blueprint $table) {
        $table->integer('del_fig')->default(0)->nullable();
    });
}

public function up()
{
    Schema::create('players', function (Blueprint $table) {
        // 他のカラムの定義

        $table->timestamps(); // この行を追加
    });
}


public function up()
{
    Schema::table('players', function (Blueprint $table) {
        $table->dropColumn(['created_at', 'updated_at']); // created_at と updated_at カラムを削除
        $table->timestamps(); // timestamps カラムを再度追加
    });
}


};