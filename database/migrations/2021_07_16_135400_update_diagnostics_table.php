<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiagnosticsTable extends Migration
{
    public function up()
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->foreignId("user_id")
                ->nullable(false)
                ->references("id")->on("users");
        });
    }

    public function down()
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

}