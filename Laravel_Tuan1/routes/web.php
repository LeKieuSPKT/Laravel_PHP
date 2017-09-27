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

Route::get('/', function () {
    return view('welcome');
});

//Truyền tham số trên 1 Route
Route::get('user/{id}', function($id){
	echo "Hello I'm User".$id;
});

//Truyền nhiều tham số trên Route
Route::get('user2/{id}/{name}',function($id, $name){
	echo "Hello I'm User  ".$id. "and My name is ".$name;
});

//Đặt ddieuf kiện cho tham số
Route::get('user3/{id}/{name}', function($id, $name){
	echo "Hello I'm User  ".$id. " and My name is ".$name;
})->where(['id'=>'[0,9]+']);

//Định danh
Route::get('Route1', ['as'=>'MyRoute1', function(){
	echo "Xin chào các bạn";
}]);

Route::get('Route2', function(){
	echo "Đay là Route2";
})->name('MyRoute2');

Route::get('GoiTen', function(){
	return redirect()->route("MyRoute2");
});

//Group
Route::group(['prefix'=>'admin'], function(){
	Route::get('product', function(){
		echo "Đây là Product";
	});

	Route::get('user4', function(){
		echo "Đây là user";
	});
});

//Sử dụng đối số
Route::get('view1', function(){
	$name = "Teo";
	return view('greeting',['name'=>$name]);
});


//Dùng phương thức with
Route::get('view2', function(){
	$name = 'Teo';
	return view('greeting')->with('name', $name);
});

//Sử dụng Compact
Route::get('view3', function(){
	$name = 'Teo';
	return view('greeting', compact('name'));
});

//Blade
//
Route::get('blade', function(){
	return view('pages.laravel');
});


Route::get('sayHello', ['as'=>'SayHello',
	'uses'=>'MyController@sayHello'
]);