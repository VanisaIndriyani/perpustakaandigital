<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turnitin_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('judul', 180);
            $table->string('file_doc', 255);
            $table->string('status', 20)->default('submitted');
            $table->unsignedTinyInteger('similarity_percent')->nullable();
            $table->string('report_pdf', 255)->nullable();
            $table->string('catatan_admin', 255)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turnitin_submissions');
    }
};

