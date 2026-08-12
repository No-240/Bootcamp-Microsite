<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('sub_bio')->nullable()->after('bio');
            $table->string('twitter')->nullable()->after('instagram');
            $table->string('facebook')->nullable()->after('twitter');
            $table->string('tiktok')->nullable()->after('facebook');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['sub_bio', 'twitter', 'facebook', 'tiktok']);
        });
    }
};
