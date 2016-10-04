<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests;
use Auth;

class CommentController extends Controller
{
  /**
   * List all comment and count the total number of comments
   */
  public function lister() {
    return view('comment/list', [
      // Dans la vue il suffira d'appeler $users ou $count
      'comments'=> Comment::selectComment(['id','user_id','article_id','content','note','created_at','etat']),
      'count'=> Comment::countComment()->numberComment
    ]);
  }

  /**
   * Chnage the state of a comment
   * @param  int $id id of the comment we want to change state
   */
  public function etat($id){
    $comment = Comment::find($id);
    $comment->etat++;
    if($comment->etat > 2) $comment->etat = 0;
    $comment->save();

    return redirect()->route('commentlist')
                     ->with('success', "L'état du commentaire a bien été modifié");
  }

  /**
   * Delete one comment in database
   * @param  int $id id of the comment we want to delete
   */
  public function delete($id) {
    $comment = Comment::find($id);
    $comment->delete();
    return redirect()->back()
                     ->with('success', "Le commentaire a bien été supprimé");
  }

  /**
   * Get the comment of an article with info about user who commented it
   * @param  int $id if od the article
   */
  public function commentOfArticle($id) {
    return Comment::select('comment.id as id', 'comment.content as content', 'comment.note as note', 'comment.created_at as created_at', 'comment.etat as etat', 'user.nom as nom', 'user.prenom as prenom', 'user.image as image')
                    ->join('user', 'user.id', '=', 'comment.user_id')
                    ->where('comment.article_id', $id)
                    ->get();
  }

  /**
   * Add comment in database
   */
  public function add(Request $request, $id) {
    $comment = new Comment();
    $comment->content = $request->content;
    $comment->note = $request->note;
    $comment->etat = 1;
    $comment->article_id = $id;
    $comment->user_id = Auth::user()->id; // réucpère l'id de l'utilisateur connecté;
    $comment->save(); // created_at at now() automatically filled by Laravel
  }


// End of controller
}
