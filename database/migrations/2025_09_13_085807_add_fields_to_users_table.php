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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('surname')->after('name');
            $table->date('hire_date')->nullable()->after('remember_token');
            $table->string('department')->nullable()->after('hire_date');
            $table->string('position')->nullable()->after('department');
            $table->boolean('is_admin')->default(false)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('surname');
            $table->dropColumn('hire_date');
            $table->dropColumn('department');
            $table->dropColumn('position');
            $table->dropColumn('is_admin');
        });
    }
};
