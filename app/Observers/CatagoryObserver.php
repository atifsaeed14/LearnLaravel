<?php

namespace App\Observers;

use App\Models\Catagory;

class CatagoryObserver
{
    /**
     * Handle the Catagory "created" event.
     */
    public function created(Catagory $catagory): void
    {
          $catagory->members()->attach([$catagory->user_id]);

    }

    /**
     * Handle the Catagory "updated" event.
     */
    public function updated(Catagory $catagory): void
    {
        //
    }

    /**
     * Handle the Catagory "deleted" event.
     */
    public function deleted(Catagory $catagory): void
    {
        //
    }

    /**
     * Handle the Catagory "restored" event.
     */
    public function restored(Catagory $catagory): void
    {
        //
    }

    /**
     * Handle the Catagory "force deleted" event.
     */
    public function forceDeleted(Catagory $catagory): void
    {
        //
    }
}
