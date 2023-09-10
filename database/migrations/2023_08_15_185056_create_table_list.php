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
        Schema::create('main_list', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("shop");
            $table->string("name");
            $table->integer("quantity");
            $table->datetime("datesell");
            $table->string("productid");
            $table->integer('summ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_list');
    }
};
