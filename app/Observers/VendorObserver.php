<?php

namespace App\Observers;

use App\Vendor;
use App\Reviews;

class VendorObserver
{
    /**
     * Handle the vendor "created" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function created(Vendor $vendor)
    {
        $review=new Reviews();
        $review->user_id=-1;
        $review->vendor_id=$vendor->id;
        $review->rate=5;
        $review->feedback='';
        $review->save();
    }

   
    
    
}
