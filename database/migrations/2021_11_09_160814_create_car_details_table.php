<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->string('color')
                ->nullable();
            $table->boolean('is_four_wheel')
                ->default(false);
            $table->integer('tank_capacity');
            $table->string('fuel_type')
                ->default('Petrol');
            $table->double('fuel_economy')->nullable();
            $table->integer('battery_capacity')->nullable();
            $table->integer('top_speed');
            $table->integer('acceleration');
            $table->integer('seating_capacity')
                ->default(4);
            $table->boolean('is_auto_drive')
                ->default(false);
            $table->string('plate_number')
                ->nullable();
            $table->string('driving_mode');
            $table->date('manufactured_at');
            $table->text('description')
                ->nullable();
            $table->double('price');
            $table->integer('number_of_cylinders');
            $table->integer('engine_capacity');
            $table->integer('gearbox_speeds');
            $table->foreignId('car_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_details');
    }
}
