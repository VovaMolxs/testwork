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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->char("firstname");
            $table->char("surname");
            $table->char("lastname")->nullable();
            $table->date("date_born");
            $table->char("email")->nullable();
            $table->char("user_phone");
            $table->integer("family_status");
            $table->text("about")->nullable();
            $table->text("files");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
