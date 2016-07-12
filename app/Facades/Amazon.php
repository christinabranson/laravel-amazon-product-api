<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Amazon extends Facade{
    protected static function getFacadeAccessor(){
        return 'amazon';
        
    }
}