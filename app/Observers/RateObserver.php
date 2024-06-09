<?php

namespace App\Observers;

use App\Models\Rate;

class RateObserver
{
    /**
     * Handle the Rate "created" event.
     *
     * @param  \App\Models\Rate  $rate
     * @return void
     */
    public function created(Rate $rate)
    {
        // Recalculate the rating of the article
        $rate->article->updateRating();
    }

    /**
     * Handle the Rate "updated" event.
     *
     * @param  \App\Models\Rate  $rate
     * @return void
     */
    public function updated(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "deleted" event.
     *
     * @param  \App\Models\Rate  $rate
     * @return void
     */
    public function deleted(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "restored" event.
     *
     * @param  \App\Models\Rate  $rate
     * @return void
     */
    public function restored(Rate $rate)
    {
        //
    }

    /**
     * Handle the Rate "force deleted" event.
     *
     * @param  \App\Models\Rate  $rate
     * @return void
     */
    public function forceDeleted(Rate $rate)
    {
        //
    }
}
