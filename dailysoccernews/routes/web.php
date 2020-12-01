<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// frontend route
/*Route::get('/', ['as' => 'frontend-home', function () {
    return view('frontend.home');
}]);*/


Route::get('/about', ['as' => 'frontend-home', function () {
    return view('frontend.home');
}]);
Route::get('/', ['as' => 'frontend-home', 'uses' => 'Forntend\HomeController@index']);
Route::get('/blog', ['as' => 'frontend-blog', 'uses' => 'Forntend\PostsController@posts']);
Route::get('/post/{slug}', ['as' => 'frontend-post-details', 'uses' => 'Forntend\PostController@details']);
//category
Route::get('/category/{slug}', ['as' => 'frontend-category-posts', 'uses' => 'Forntend\PostController@category_posts']);
//category
Route::get('/tag/{slug}', ['as' => 'frontend-tag-posts', 'uses' => 'Forntend\PostController@tag_posts']);
// subscribe
Route::post('/subscribe', ['as' => 'UserSubscribe', 'uses' => 'SubscriberController@store']);
// search route
Route::get('/search', ['as' => 'Search', 'uses' => 'SearchController@query']);
// contact form
Route::get('/contact', ['as' => 'Contact', 'uses' => 'Forntend\ContactController@index']);
Route::post('/contact/send', ['as' => 'ContactSend', 'uses' => 'Forntend\ContactController@send']);
// frontend route end

//Route::get('/test','MyController@index');
Auth::routes();

Route::group(['middleware'=>['auth'] ],function (){
    Route::post('/favorite/add/{id}', ['as' => 'Favorite', 'uses' => 'FavoriteController@add']);
    Route::post('/comment/{id}', ['as' => 'Comment', 'uses' => 'CommentController@store']);
}
);

// Admin Group Routes
Route::group(['as'=>'admin','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin'] ],function (){
        Route::get('/dashboard','AdminDashboardController@index')->name('admin-dashboard');
        //Route::resource('/tag','TagController');
        Route::get('/tag', ['as' => 'Tag', 'uses' => 'TagController@index']);
        Route::post('/tag/store', ['as' => 'TagStore', 'uses' => 'TagController@store']);
        Route::get('/tag/delete/{id}', ['as' => 'TagDelete', 'uses' => 'TagController@destroy']);
        Route::post('/tag/edit/{id}', ['as' => 'TagEdit', 'uses' => 'TagController@edit']);
        Route::post('/tag/update/{id}', ['as' => 'TagEdit', 'uses' => 'TagController@update']);
       // Category
        Route::get('/category', ['as' => 'Tag', 'uses' => 'CategoryController@index']);
        Route::post('/category/store', ['as' => 'CategoryStore', 'uses' => 'CategoryController@store']);
        Route::get('/category/delete/{id}', ['as' => 'CategoryDelete', 'uses' => 'CategoryController@destroy']);
        Route::post('/category/edit/{id}', ['as' => 'CategoryEdit', 'uses' => 'CategoryController@edit']);
        Route::post('/category/update/{id}', ['as' => 'CategoryUpdate', 'uses' => 'CategoryController@update']);
        // Post
        Route::get('/post', ['as' => 'Post', 'uses' => 'PostController@index']);
        Route::get('/post/create', ['as' => 'PostCreate', 'uses' => 'PostController@create']);
        Route::post('/post/store', ['as' => 'PostStore', 'uses' => 'PostController@store']);
        Route::get('/post/delete/{id}', ['as' => 'PostDelete', 'uses' => 'PostController@destroy']);
        Route::get('/post/show/{id}', ['as' => 'PostShow', 'uses' => 'PostController@show']);
        Route::get('/post/edit/{id}', ['as' => 'PostEdit', 'uses' => 'PostController@edit']);
        Route::post('/post/update/{id}', ['as' => 'TagUpdate', 'uses' => 'PostController@update']);
        // User
        Route::get('/user', ['as' => 'User', 'uses' => 'UserController@index']);       
        Route::get('/user/create', ['as' => 'UserCeate', 'uses' => 'UserController@create']);       
        Route::post('/user/store', ['as' => 'UserStore', 'uses' => 'UserController@store']);       
        Route::get('/user/edit/{id}', ['as' => 'UserEdit', 'uses' => 'UserController@edit']);       
        Route::post('/user/update/{id}', ['as' => 'UserUpdate', 'uses' => 'UserController@update']);
        Route::get('/user/delete/{id}', ['as' => 'UserDelete', 'uses' => 'UserController@destroy']);
        //Pending Post
        Route::get('post/pending', ['as' => 'PendingPost', 'uses' => 'PostController@pending']);           
        Route::post('/pending/approved/{id}', ['as' => 'PendingPostApproved', 'uses' => 'PostController@approved']);           
        Route::get('/subscriber', ['as' => 'Subscriber', 'uses' => 'SubscriberController@index']);       
        Route::post('/subscriber/store', ['as' => 'SubscriberStore', 'uses' => 'SubscriberController@store']);       
        Route::get('/subscriber/update/{id}', ['as' => 'SubscriberUpdate', 'uses' => 'SubscriberController@update']);       
        Route::get('/subscriber/delete/{id}', ['as' => 'SubscriberDelete', 'uses' => 'SubscriberController@destroy']);       
       // Route::get('/subscriber', ['as' => 'Subscriber', 'uses' => 'SubscriberController@index']);    
       Route::get('/favorite','FavoriteController@index')->name('AdminFevorite');   
       Route::get('/comment','CommentController@index')->name('AdminComment');   
       //comment  
       Route::post('/comment/update/{id}','CommentController@update')->name('AdminCommentUpdate');   
       Route::post('/comment/delete/{id}','CommentController@destroy')->name('AdminCommentDelete');   
}
);
// subscriber route
// Author Group Routes
Route::group(['as'=>'author','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author'] ],function (){
        Route::get('/dashboard','AuthorDashboardController@index')->name('AuthorDashboard');
        // Author Post
        Route::get('/post','PostController@index')->name('AuthorPost');
        Route::get('/post/create','PostController@create')->name('AuthorPostCreate');
        Route::post('/post/store','PostController@store')->name('AuthorPostStore');
        Route::get('/post/show/{id}','PostController@show')->name('AuthorPostShow');
        Route::get('/post/edit/{id}','PostController@edit')->name('AuthorPostEdit');
        Route::post('/post/update/{id}','PostController@update')->name('AuthorPostUpdate');
         // Author profile
        Route::get('/profile','ProfileController@index')->name('AuthorProfile');
        Route::get('/profile/edit/','ProfileController@edit')->name('AuthorProfileEdit');
        Route::post('/profile/update','ProfileController@update')->name('AuthorProfileUpdate');
        Route::get('/fevorite','FevoriteController@index')->name('AuthorFevorite');

}
);














Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
