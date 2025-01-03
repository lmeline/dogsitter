<?php

use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Models::table('messages'), function (Blueprint $table) {
            $table->id();
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();
  
            // $table->string('contenu');
            // $table->dateTime('date_envoi');
            // $table->boolean('lu')->default(false);
            // $table->foreignId('expediteur_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignId('destinataire_id')->references('id')->on('users')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Models::table('messages'));
    }
}
