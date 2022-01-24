<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Setting extends Model
{
    protected $collection = 'settings';

    protected $guarded=[];
}
