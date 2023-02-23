<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('phone');
			$table->integer('blood_type_id')->unsigned();
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->string('pin_code')->nullable();
			$table->boolean('is_active')->default(1);
			$table->string('api_token',60)->unique()->nullable();
            $table->enum('status', [0,1])->default(1);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
