<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('plan_id');
            $table->string('name')->unique();
            $table->string('NIF')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

            //Estado do tenant

            $table->enum('active',['Y', 'N'])->default('Y');

            //DAados da subscricao
            $table->date('subscription')->nullable();//Data em que se inscreveu
            $table->date('expires_at')->nullable();//Data em que a subscricao expira
            $table->string('subscription_id', 255)->nullable();//Identificacao no gateway de pagamento
            $table->boolean('subscription_active')->default(false);
            $table->boolean('subscription_suspended')->default(false);


            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
