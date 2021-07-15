<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId("organization_id")
                ->nullable(true)
                ->references("id")->on("organizations")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("advise_id")
                ->nullable(true)
                ->references("id")->on("advises")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("classification_id")
                ->nullable(true)
                ->references("id")->on("classifications")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->decimal('free_cash_flow_to_total_debt');
            $table->decimal('accounts_payable_turnover');
            $table->decimal('operating_margin');
            $table->decimal('sales_per_employee');
            $table->decimal('asset_turnover');
            $table->decimal('total_debt_to_total_assets');
            $table->decimal('current_ratio');
            $table->decimal('revenue_growth_year_over_year');
            $table->decimal('return_on_assets');
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
        Schema::dropIfExists('diagnostics');
    }
}
