<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function request() {
        $userId = Auth::id();
        $courseId = $_POST['course_id'];

        $alredySubscribed = Subscribe::where('course_id', $courseId)->where('user_id', $userId)->count();

        if($alredySubscribed > 0) {
            echo 0;
        } else {
            $subscribe = new Subscribe();
            $subscribe->course_id = $courseId;
            $subscribe->user_id = $userId;

            $subscribe->save();

            /*Mail::raw('test', function ($message) use ($messageBody) {
                $message->from('weblime@domain.com', 'Elerning');
                $message->to('weblime.studio@gmail.com');
                $message->subject('test'); 
            });*/

            echo 1;
        }
    }

    public function setmessage() {
        $fromUserId = Auth::id(); //From

        $toUserId = $_POST['userid'];
        $message = $_POST['message'];

        if( $toUserId == null || $toUserId <= 0 || $message == null ) {
            return;
        }
echo 'test22';
        /*if($fromUserId < $toUserId) {
            $chat = Chat::where('user_1', $fromUserId)->where('user_2', $toUserId)->first();
        } else {
            $chat = Chat::where('user_1', $toUserId)->where('user_2', $fromUserId)->first();
        }
        
        if(!$chat) {
            $chat = new Chat();
        }*/

        $chat = new Chat();


        if($fromUserId < $toUserId) {
            $chat->user_1 = $fromUserId;
            $chat->user_2 = $toUserId;
            $chat->message = $message;
        } else {
            $chat->user_1 = $toUserId;
            $chat->user_2 = $fromUserId;
            $chat->message = $message;
        }
        $chat->save();        
    }

    public function getmessage() {
        $fromUserId = Auth::id(); //From
        $toUserId = $_GET['user_id'];


        
        if($fromUserId < $toUserId) {
            $chat = Chat::orderBy('created_at', 'asc')->where('user_1', $fromUserId)->where('user_2', $toUserId)->get();
        } else {
            $chat = Chat::orderBy('created_at', 'asc')->where('user_1', $toUserId)->where('user_2', $fromUserId)->get();
        }

        if($chat) {
            $chatList = '';
            foreach($chat as $message) {                     
                if($message->dirrection == 0) {
                    $user = User::where('id', $fromUserId)->first();
                    $chatList .= '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-right">' . $user->name . '</span> <span class="direct-chat-timestamp float-left">' . $message->created_at  . '</span></div><img alt="' . $user->name . '" class="direct-chat-img" src="/storage/' . $user->profile_photo_path . '"><div class="direct-chat-text">' . $message->message . '</div></div>';
                } else {
                    $user = User::where('id', $toUserId)->first(); 
                    $chatList .= '<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">' . $user->name . '</span> <span class="direct-chat-timestamp float-right">' . $message->created_at  . '</span></div><img alt="' . $user->name . '" class="direct-chat-img" src="/storage/' . $user->profile_photo_path . '"><div class="direct-chat-text">' . $message->message . '</div></div>';
                }

            }
        }

        echo $chatList;
    }




}
