<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

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

Route::get('eloquent', function () {
    //Para obtener todos!
    // $posts =  Post::all();
    $posts =  Post::where('id','>=','20')
    //Para discriminar por id
        ->orderBy('id','desc')
        //Para ordenar descendente
        ->take(5)        
        //Para tomar solo 5
        ->get();
        //para obtener


    foreach ($posts as $post) {
        echo "$post->id"." id_user: "."$post->user_id $post->get_title <br>";
    }
});

Route::get('posts', function () {
    $posts =  Post::get();

    foreach ($posts as $post) {
        echo "$post->id
        "." id_user: "."$post->user_id
        <strong>{$post->user->get_name}</strong>
        TITLE: 
        $post->get_title <br>";
        // el metodo user fue el que cree en el modelo Post.php
    }
});
Route::get('users', function () {
    $users =  User::get();

    foreach ($users as $user) {
        echo "
        $user->id
        <strong>$user->get_name</strong>
        {$user->posts->count()} posts <br>";
        //Este metodo posts fue el método que configure en User.php
    }
});
Route::get('collections', function () {
    $users = User::all();
    // dd($users);
    // dd($users->contains(4));
    // dd($users->except([1,3]));
    // dd($users->only(4));
    // dd($users->find([2,4]));
    dd($users->load('posts'));
    // Se usa para cargar las relaciones con posts, se usa el metodo posts porque como lo definimos en User.php
}
);

Route::get('serializacion', function () {
    $users = User::all();

    // dd($user->toArray());

    $user = $users->find(1);
    // dd($user);
    dd($user->toJson());
}
);