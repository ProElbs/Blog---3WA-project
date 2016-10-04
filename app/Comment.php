<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Comment extends Model
{
    protected $table = "comment";

    /**
     * Get all comment from table paginated by 10
     * @param  array  $table columns required
     */
    public static function selectComment(array $table) {
      return DB::table('comment')->select($table)->Paginate(10);
    }

    /**
     * Count total number of comment in database
     */
    public static function countComment() {
      return DB::table('comment')->select(DB::raw('count(*) as numberComment'))->first();
    }

    /**
     * Get number of comment where the state is $online
     * @param  int $online state of the comment
     */
    public static function getNbCommentActif($online) {
      return DB::table('comment')->select(DB::raw('count(*) as nb'))
                                 ->where('etat', $online)
                                 ->first();
    }

    // SELECT COUNT(id) as value
    // FROM comment
    // WHERE YEAR(created_at) = 2016
    /**
     * Get number of comment per year
     * @param  int $annee year required
     */
    public static function getCommentByYear($annee) {
      return Comment::select(DB::raw('COUNT(*) as value'))
                    ->whereYear('created_at', '=', $annee)
                    ->first()
                    ->value;
    }

    /**
     * Get number of comment per article
     * @param  int $id id of the article
     */
    public static function getNbCommentOfArticle ($id) {
      return Comment::select(DB::raw('COUNT(*) as value'))
                    ->join('article', 'article.id', '=', 'comment.article_id')
                    ->where('comment.article_id', $id)
                    ->first()
                    ->value;
    }


// End of class
}
