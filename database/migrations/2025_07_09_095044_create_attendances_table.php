<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('user_identity');
            $table->string('ip_exit')->nullable();
            $table->decimal('distance', 10, 2)->nullable();
            $table->decimal('distance_exit', 10, 2)->nullable();
            $table->string('ip_address');
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();
            $table->geometry('entry_location', 'POINT', 4326)->nullable();
            $table->geometry('exit_location', 'POINT', 4326)->nullable();
            $table->geometry('office_location', 'POINT', 4326)->nullable();

            $table->timestamps();
        });
//        DB::statement("ALTER TABLE attendances ADD COLUMN entry_location geometry(Point, 4326)");
//        DB::statement("ALTER TABLE attendances ADD COLUMN exit_location geometry(Point, 4326)");
//        DB::statement("ALTER TABLE attendances ADD COLUMN office_location geometry(Point, 4326)");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
