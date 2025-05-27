<?php

use Carbon\Carbon;
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
        Schema::create('garbage_collection_request_collectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->on('garbage_collection_requests');
            $table->foreignId('collector_id')->constrained()->on('collectors');
            $table->datetime('assigned_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garbage_collection_request_collectors');
    }
};
