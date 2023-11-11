<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class Commons extends Controller{

    /* 
    |   Docu: This Method will get the difference in date / time now and date / time updated. "X time ago"
    */
    public function getTimeAgo($carbonObject) {
        $updatedAt = Carbon::parse($carbonObject);
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
            $updatedAt->diffForHumans()
        );
    }
    
}
