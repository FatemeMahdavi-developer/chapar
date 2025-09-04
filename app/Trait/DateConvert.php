<?php

namespace App\Trait;

use Morilog\Jalali\Jalalian;

trait DateConvert
{
    public function date_convert($column='created_at',$format='Y/m/d'){
        return Jalalian::forge($this->$column)->format($format);
    }
}
