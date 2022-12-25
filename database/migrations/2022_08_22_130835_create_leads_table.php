<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->onDelete('set null');;
            $table->string('sm')->nullable();
            $table->string('app_num')->nullable();
            $table->foreignId('flr_name')->nullable()->onDelete('set null');
            $table->string('customer_num');
            $table->string('customer_name');
            $table->string('salary')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('loan_amount');
            $table->integer('disbused_amount')->nullable();
            $table->foreignId('bank')->nullable()->onDelete('set null');
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
