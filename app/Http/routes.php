<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// middleware filtre d'authentification = uniquement si connecter, on peut voir les pages suivantes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
  /**
   * Homepage and stats
   */
  Route::get('/', 'HomepageController@homepage')->name('homepage');
  Route::get('/langue/{locale}', 'HomepageController@langue')->name('langue');
  Route::get('/categories-stats', 'HomepageController@statsCategories')->name('statsCategories');
  Route::get('/articles-stats', 'HomepageController@statsArticles')->name('statsArticles');
  Route::get('/comments-stats', 'HomepageController@statsComments')->name('statsComments');
  /**
   * Chat
   */
  Route::get('/chat/{take?}', 'chatController@getContent') ->name('chat');
  Route::post('/chat-add', 'chatController@add')->name('chatAdd');
  /**
   * Get comment of random article
   */
  Route::get('/comment-article/{id}', 'CommentController@commentOfArticle')->name('randomArticle');
  Route::post('/comment-add/{id}', 'CommentController@add')->name('commentAdd');
  /**
   * Tweet
   */
  Route::post('/add-tweet', 'HomepageController@addTweet')->name('addTweet');

  /**
   * Default pages
   */
  //NomDuController@NomDeLaMéthodeDuController
  Route::any('/contact', 'ContactController@contact')->name('contact');

  Route::get('/faq', function () {
      return view('faq');
  })->name('faq');

  Route::get('/concept', function () {
      return view('concept');
  })->name('concept');

  Route::get('/about', function () {
      return view('about');
  })->name('about');

  /**
   * Media
   */
  Route::any('/media', 'MediaController@media')->name('media');

  /**
   * User
   */
  // Un groupe de route permet de les préfixer au niveau URI
  Route::group(['prefix' => 'user','as' => 'user'], function () {
    Route::any('/add', 'UserController@add')->name('add');
    Route::get('/list', 'UserController@lister')->name('list');
    // End group user
  });

  /**
   * Article
   */
  Route::group(['prefix' => 'article','as' => 'article'], function() {
    Route::get('/list', 'ArticleController@lister')->name('list');
    Route::get('/visibilite/{id}/{visibilite}', 'ArticleController@visibilite')->name('visibilite');
    Route::get('/delete/{id}', 'ArticleController@delete')->name('delete');
    Route::get('/detail/{id}', 'ArticleController@detail')->name('detail');
    Route::get('/pdf/{id}', 'ArticleController@exportPdf')->name('exportPdf');
    Route::get('/favorite/{id}/{titre}', 'ArticleController@favorite')
    ->where('id','[0-9]+')
    ->name('favorite');
    Route::get('/favorite/clear/{id?}', 'ArticleController@clearFavorite')->name('clearFavorite');
    Route::any('/summaryPayment', 'ArticleController@summaryPayment')->name('summaryPayment');
    // End group article
  });

  /**
   * Comment
   */
  Route::group(['prefix' => 'comment','as' => 'comment'], function() {
    Route::get('/list', 'CommentController@lister')->name('list');
    Route::get('/etat/{id}', 'CommentController@etat')->name('etat');
    Route::get('/delete/{id}', 'CommentController@delete')->name('delete');
    // End group comment
  });

// End group middleware admin
});

Route::auth();
