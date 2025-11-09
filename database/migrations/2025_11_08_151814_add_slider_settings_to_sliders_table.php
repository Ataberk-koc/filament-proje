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
        Schema::table('sliders', function (Blueprint $table) {
            $table->json('button_text')->nullable()->after('description');
            $table->string('button_link')->nullable()->after('button_text');
            $table->integer('autoplay_delay')->default(5000)->after('order');
            $table->boolean('show_navigation')->default(true)->after('autoplay_delay');
            $table->boolean('show_pagination')->default(true)->after('show_navigation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn(['button_text', 'button_link', 'autoplay_delay', 'show_navigation', 'show_pagination']);
        });
    }
};
