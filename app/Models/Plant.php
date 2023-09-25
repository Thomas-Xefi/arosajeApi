<?php

namespace App\Models;

use App\Models\Filters\PlantSpeciesFilter;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name', 'description', 'price', 'plant_species_id', 'status_id', 'guardian_id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function tips(): BelongsToMany
    {
        return $this->belongsToMany(Tip::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function species(): BelongsTo {
        return $this->belongsTo(PlantSpecies::class, 'plant_species_id');
    }
}
