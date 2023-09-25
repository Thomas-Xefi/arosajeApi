<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'status';

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }
}
