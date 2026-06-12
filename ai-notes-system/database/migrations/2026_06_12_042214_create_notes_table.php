<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function ($table) {

            $table->id();

            $table->string('title');

            $table->longText('content');

            $table->longText('summary')->nullable();

            $table->json('embedding')->nullable();

            $table->timestamps();
        });
    }
};
