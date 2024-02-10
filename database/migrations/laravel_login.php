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
        Schema::create('users', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('country_id')->default(0);
            $table->string('email',100)->unique;
            $table->string('password',100);
            $table->unsignedInteger('role')->default(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
    
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // デフォルト値を変更し、1または0のみを許可
            $table->integer('role')->default(0)->nullable(false)->change();
            $table->checkIndex(['role'], 'role_check')->where('role', '=', 0)->orWhere('role', '=', 1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

?>