<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'onboardings', function( Blueprint $table )
		{
            $table->bigIncrements('id');
			$table->integer('user_id');
            $table->date('created_at');
            $table->integer('onboarding_percentage')->default( 0 );
            $table->integer('count_applications');
            $table->integer('count_accepted_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onboardings');
    }
}
