<?php

use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Status::query()->insert([
            'id' => Str::uuid(),
            'name' => 'Brouillon',
            'slug' => 'draft',
        ]);

        Status::query()->insert([
            'id' => Str::uuid(),
            'name' => 'En attente',
            'slug' => 'pending',
        ]);

        Status::query()->insert([
            'id' => Str::uuid(),
            'name' => 'Gardée',
            'slug' => 'guarded',
        ]);

        Status::query()->insert([
            'id' => Str::uuid(),
            'name' => 'Terminée',
            'slug' => 'closed',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
