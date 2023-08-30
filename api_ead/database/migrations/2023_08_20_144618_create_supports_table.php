<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('lesson_id')->nullable(false);
            $table->foreign('lesson_id')->on('lessons')->references('id');

            $table->uuid('user_id')->nullable(false);
            $table->foreign('user_id')->on('users')->references('id');

            $table->text('description');
            $table->enum('status', ['pending','waiting', 'concluded'])->default('pending');

            $table->timestamp('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
};
