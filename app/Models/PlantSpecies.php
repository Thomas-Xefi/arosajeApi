<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlantSpecies
 *
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PlantSpeciesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantSpecies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlantSpecies extends Model
{
    use HasFactory, HasUuids;
}
