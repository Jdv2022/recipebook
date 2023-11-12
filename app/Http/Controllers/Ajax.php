<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Commons;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class Ajax extends Controller{

    public function review(){
        $commonFunctions = new Commons;
        $commentModel = new Comment;
        $replyModel = new Reply;

        $data = [];
        
        $comments = $commentModel->all();
        foreach($comments as $comment){
            $commentUser = $commentModel->find($comment['id'])->replies;
            $commentsOwner = $commentModel->find($comment['id'])->user;

            $repliesData = [];

            foreach($commentUser as $perUser){
                $replyReturns = $replyModel->find($perUser['id'])->user;
                $repliesData[] = [
                    'first_name' => $replyReturns['first_name'],
                    'last_name' => $replyReturns['last_name'],
                    'reply' => $perUser['content'],
                    'reply_date' => $commonFunctions->getTimeAgo($perUser['created_at']),
                ];
            }
            $data[] = [
                'id' => $comment['id'],
                'first_name' => $commentsOwner['first_name'],
                'last_name' => $commentsOwner['last_name'],
                'comment' => $comment['content'],
                'time' => $commonFunctions->getTimeAgo($comment['created_at']),
                'replies' => $repliesData,
            ];
        }

        return view('reviewsAjax', ['comments' => $data]);
    }

    public function rating(){
        $ratingModel = new Rating;
        $alreadyRated = $ratingModel->where('user_id', Auth::id())->exists();
        $data = [
            '5' => $ratingModel->where('rating', 5)->count(),
            '4' => $ratingModel->where('rating', 4)->count(),
            '3' => $ratingModel->where('rating', 3)->count(),
            '2' => $ratingModel->where('rating', 2)->count(),
            '1' => $ratingModel->where('rating', 1)->count(),
        ];
        return view('rating', ['rating_data' => $data, 'alreadyRated' => $alreadyRated]);
    }
    
}
