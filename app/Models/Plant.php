<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Plant
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property float|null $price
 * @property string|null $img_url
 * @property string $plant_species_id
 * @property string|null $status_id
 * @property string|null $owner_id
 * @property string|null $guardian_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $guardian
 * @property-read \App\Models\User|null $owner
 * @property-read \App\Models\PlantSpecies $species
 * @property-read \App\Models\Status|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tip> $tips
 * @property-read int|null $tips_count
 * @method static \Database\Factories\PlantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereGuardianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant wherePlantSpeciesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
