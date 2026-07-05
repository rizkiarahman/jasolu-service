<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {

            $table->id();

            $table->foreignId('vehicle_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('service_date');

            $table->text('complaint');

            $table->text('diagnosis')->nullable();

            $table->decimal('service_cost',12,2)->default(0);

            $table->decimal('sparepart_cost',12,2)->default(0);

            $table->decimal('total_cost',12,2)->default(0);

            $table->enum('status',[
                'Waiting',
                'In Progress',
                'Completed',
                'Cancelled'
            ])->default('Waiting');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};