<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id');
            $table->integer('stars_rating');
            $table->text('feedback')->nullable();
            $table->softDeletes(); 
            $table->timestamps();

           
        });
    }

    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->renameColumn('feedback', 'feedback');
        });
    }
}

