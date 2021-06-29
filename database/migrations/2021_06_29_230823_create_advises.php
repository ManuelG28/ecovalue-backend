<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

class CreateAdvisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advises', function (Blueprint $table) {
            $table->id();
            $table->foreignId("diagnostic_id")
                ->nullable(false)
                ->references("id")->on("diagnostics")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->string('leverage');
            $table->string('growth');
            $table->string('eficiency');
            $table->string('cost_effectiveness');
            $table->string('solvency');
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
        Schema::dropIfExists('advises');
    }
}