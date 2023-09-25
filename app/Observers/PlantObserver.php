<?php

namespace App\Observers;

use App\Models\Message;
use App\Models\Plant;
use App\Models\PlantSpecies;
use App\Models\Status;
use App\Models\User;
use App\Notifications\PlantIsGuardedNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PlantObserver
{
    public function created(Plant $plant): void
    {
        //
    }

    public function creating(Plant $plant): void
    {
        $plant->owner()->associate(Auth::user());
        $plant->status_id = Status::where('slug', 'draft')->first()->getKey();
    }

    public function updating(Plant $plant): void
    {
        if ($plant->isDirty('guardian_id')) {
            $plant->status_id = Status::whereSlug('guarded')
                ->first()
                ->getKey();

            $sender = User::find($plant->guardian_id);
            $receiver = User::find($plant->owner_id);

            $receiver->notify(new PlantIsGuardedNotification($plant));
        }
    }

    public function updated(Plant $plant): void
    {
        //
    }

    public function deleted(Plant $plant): void
    {
        //
    }

    public function restored(Plant $plant): void
    {
        //
    }

    public function forceDeleted(Plant $plant): void
    {
        //
    }
}
