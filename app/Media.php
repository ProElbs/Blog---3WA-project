<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  /**
  * Liaison entre le Model et la table
  * Nom de ma table
  */
  protected $table = "media";

  /**
   * Get number of media in table
   */
  public static function countMedia() {
    return DB::table('media')->select(DB::raw('count(*) as nb'))
                             ->first();
  }

  /**
   * get media present in article_media table
   */
  public static function getMediaInArticle() {
    return DB::table('media')
            ->join('article_media', 'media.id', '=', 'article_media.media_id')
            ->groupBy('article_media.media_id')
            ->get();
    // Autre solution via eloquent
    // return Media::join('..')->groupBy('...')->get()->count()
    // il est possible d'utiliser count car on est dans Eloquent
    // Si on utilise Query builder, le count est fait dans le controller
  }

  // Autre solution en Eloquent ManyToMany
  // public function articles() {
  //   return $this->belongsToMany('App\Article');
  //
  // }



// End of class
}
