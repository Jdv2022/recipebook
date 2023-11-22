<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Commons extends Controller{

    /* 
    |   Docu: This Method will get the difference in date / time now and date / time updated. "X time ago"
    */
    public static function getTimeAgo($carbonObject){
        $updatedAt = Carbon::parse($carbonObject);
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
            $updatedAt->diffForHumans()
        );
    }

    /* 
    |   Docu: THis deletes the old image and store new user image
    */
    public static function userPictures($params, $request, $url){
        if($params){
            $newString = str_replace("storage", "public", $params);
            Storage::delete($newString); //delete the existing image
        }
        $selection = [ // key is the keyword and value is the location of file to be saved
            'cover' => 'public/cover', 
            'profile' => 'public/profile',
            'recipemain' => 'public/recipemain',
            'recipesub' => 'public/recipesub',
        ];
        foreach($selection as $key => $value){
            if(stripos($url, $key) !== false){
                $uploadedFile = $request->file($key); 
                $uploadedFile->store($value); //new replacement
            }
        }
    }

    /* 
    |   Calculate the average rating.returns the total number of participated user and rating
    */
    public static function sortRatings($params){
        $count = 0;
        $sum = 0;
        foreach($params as $item){
            $count++;
            $sum += $item->rating; 
        }
        if($count != 0){
            return ['count' => $count, 'rating' => round($sum/$count, 2)];
        }
        return ['count' => $count, 'rating' => 0];
    }

    /* 
    |   Docu: merge sort for the featured users with best recipe ratings
    */
    public static function sortThis($array){
        if(count($array) <= 1){
            return $array;
        }
        $total = count($array);
        $left = array_slice($array, 0, ceil($total/2));
        $right = array_slice($array, ceil($total/2), $total);
        return self::mergeSort(self::sortThis($left), self::sortThis($right));
    }

    private static function mergeSort($left, $right){
        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;
        while($leftIndex < count($left) && $rightIndex < count($right)){ 
            if($left[$leftIndex]['rate']['rating'] > $right[$rightIndex]['rate']['rating']){
                $result[] = $left[$leftIndex];
                $leftIndex++;
            }
            else{
                $result[] = $right[$rightIndex];
                $rightIndex++;
            }
        }
        while($leftIndex < count($left)){
            $result[] = $left[$leftIndex];
            $leftIndex++;
        }
        while($rightIndex < count($right)){
            $result[] = $right[$rightIndex];
            $rightIndex++;
        }
        return $result;
    }    
    /* 
    |   End merge sort
    */
}
