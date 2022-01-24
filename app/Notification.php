<?php

namespace App;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $appends=[
        'title',
        'created_at_ta'
    ];

    public function getTitleAttribute()
    {
        $title;
        switch($this->type){
            case 0:
                $title='general';
                break;
            case 1:
                $title='booking status changed';
                break;
            case 2:
                $title="new booking";
                break;
            default:
                $title='amdin notify';
            
        }
        return $title;
    }

    public function getCreatedAtTaAttribute($value)
    {
        switch (request()->header('language')) {
            case 'en':
                $this->language_code = 1;
                $this->lang = "en";
                break;
            case 'ar':
                $this->language_code = 2;
                $this->lang = "ar";
                break;
            case 'fr':
                $this->language_code = 3;
                $this->lang = "fr";
                break;
            default:
                $this->language_code = 1;
                $this->lang = "en";
                break;
        }

        Date::setLocale($this->lang);
        $value = Date::parse($this->attributes['created_at']);
        $value = $value->ago();
       
        return $value;
    }
}
