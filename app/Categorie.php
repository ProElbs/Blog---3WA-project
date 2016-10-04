<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Categorie extends Authenticatable
{
    protected $table = "categorie";

    /**
     * get information about a category
     * @param  array  $table columns required
     * @param  int    $id    id of the category
     */
    public static function infoCategorie(array $table, $id) {
      return DB::table('categorie')->select($table)
                                   ->where('id', $id)
                                   ->first();
    }

    // Autres méthodes vi ORM Eloquent pour trouver le nombre de catégorie ayant des articles
    // public function articles() {
    // return $this->hasMany('App\Article');
    // }



// End of class
}
