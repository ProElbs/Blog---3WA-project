<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    protected $table = "user";
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'prenom', 'nom', 'email', 'password', 'telephone', 'code_postal', 'biographie', 'ville', 'date_naissance', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all user in table with info wanted ($table) paginated by 10
     * @param  array  $table columns required
     */
    public static function selectUser(array $table) {
      return DB::table('user')->select($table)
                              ->Paginate(10);
    }

    /**
     * Count number of user in user table
     */
    public static function countUser() {
      return DB::table('user')->select(DB::raw('count(*) as numberUser'))
                              ->first();
    }

    /**
     * get info about user wanted
     * @param  array  $table columns required
     * @param  int    $id    id of the user required
     */
    public static function infoUser(array $table, $id) {
      return DB::table('user')->select($table)
                              ->where('id', $id)
                              ->first();
    }

    // SELECT nom, email
    // FROM user
    // LEFT JOIN comment
    // ON user.id = comment.user_id
    // WHERE comment.user_id IS NULL
    /**
     * get user that didn't post any comment yet
     */
    public static function getBadUser() {
      return DB::table('user')->select('nom', 'prenom', 'email')
                              ->leftJoin('comment', 'comment.user_id', '=', 'user.id')
                              ->whereNull('comment.user_id' )
                              ->get();
    }


// End of class
}
