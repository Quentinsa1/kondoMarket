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
    Schema::table('users', function (Blueprint $table) {

        if (!Schema::hasColumn('users','role')) {
            $table->string('role')->default('customer')->after('email');
        }

        if (!Schema::hasColumn('users','last_login_at')) {
            $table->timestamp('last_login_at')->nullable();
        }

        if (!Schema::hasColumn('users','last_login_ip')) {
            $table->string('last_login_ip')->nullable();
        }

        if (!Schema::hasColumn('users','is_active')) {
            $table->boolean('is_active')->default(true);
        }

        if (!Schema::hasColumn('users','last_seen')) {
            $table->timestamp('last_seen')->nullable();
        }
    });
}
  /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'role',
            'last_login_at',
            'last_login_ip',
            'is_active',
            'last_seen'
        ]);
    });
}
};
