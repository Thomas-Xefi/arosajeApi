<?php

use App\Models\PlantSpecies;
use App\Models\Status;
use App\Models\User;
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
        Schema::create('plants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('price')->nullable();
            $table->foreignIdFor(PlantSpecies::class)->constrained();
            $table->foreignIdFor(Status::class)->nullable()->constrained('status');
            $table->foreignIdFor(User::class, 'owner_id')->nullable()->constrained('users');
            $table->foreignIdFor(User::class, 'guardian_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
