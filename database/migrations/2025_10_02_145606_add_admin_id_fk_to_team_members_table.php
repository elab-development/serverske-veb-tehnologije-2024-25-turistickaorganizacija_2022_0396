<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->foreignId('admin_id')
                  ->nullable()
                  ->after('email')
                  ->constrained('admins')
                  ->nullOnDelete(); // ili ->onDelete('set null') ako koristiš stariju verziju
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            // Ako imaš Laravel 10+ sa Blueprint helperom:
            if (Schema::hasColumn('team_members', 'admin_id')) {
                $table->dropConstrainedForeignId('admin_id');
            }

            // Ako gornja linija ne postoji u tvojoj verziji, koristi ovo umesto nje:
            // $table->dropForeign(['admin_id']);
            // $table->dropColumn('admin_id');
        });
    }
};
