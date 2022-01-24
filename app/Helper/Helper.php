<?php
namespace App\Helper;

use DB

;

class Helper
{
    public static function settings($key)
    {
        $settings = DB::table('settings')->select("key", "value")->get()->toArray();
        for ($i=0;$i<count($settings);$i++) {
            if ($settings[$i]['key']==$key) {
                return $settings[$i]['value'];
            }
        }
        return $key;
    }
}
