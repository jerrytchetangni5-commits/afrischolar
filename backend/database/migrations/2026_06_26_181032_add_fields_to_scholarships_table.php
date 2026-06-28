<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->string('region')->nullable()->after('country');
            $table->boolean('is_funded')->default(false)->after('description');
            $table->string('amount')->nullable()->after('is_funded');
            $table->integer('days_remaining')->nullable()->after('benefits');
            $table->string('source')->nullable()->after('link');
        });
    }

    public function down(): void
    {
        Schema::table('scholarships', function (Blueprint $table) {
            $table->dropColumn([
                'region',
                'is_funded',
                'amount',
                'days_remaining',
                'source'
            ]);
        });
    }
};