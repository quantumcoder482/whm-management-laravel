<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('org_name')->unique();
            $table->string('domain');
            $table->string('subdomain');
            $table->string('super_user');
            $table->string('super_password');
            $table->string('admin_user');
            $table->string('admin_password');
            $table->string('db_name');
            $table->string('db_user');
            $table->string('db_password');
            $table->string('created_by');
            $table->string('owner_name');
            $table->string('sale_type');
            $table->string('email');
            $table->Integer('status')->default(1);
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
        Schema::dropIfExists('organizations');
    }
}
