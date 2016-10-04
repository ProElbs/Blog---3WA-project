<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Http\Requests;
use Auth;

class ChatController extends Controller
{
  /**
   * Add chat message in database
   */
  public function add(Request $request) {
    $chat = new Chat();
    $chat->content = $request->content;
    $chat->user_id = Auth::user()->id; // récupère l'id de l'utilisateur connecté;
    $chat->save(); // created_at at now() automatically filled by Laravel
  }

  /**
   * getContent get the content of every
   * @param  integer $take number of message to show
   */
  public function getContent($take = 10) {
    // take(): limite au nombre indiqué
    // orderBy: trie par id descendant
    return Chat::take($take)->orderBy('id', 'desc')->get();
  }


// End of controller
}
