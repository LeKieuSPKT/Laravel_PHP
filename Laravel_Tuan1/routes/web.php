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

Route::get('database', function(){
	Schema::create('thongtin', function( $table){
		$table->increments('id');
		$table->string('email');
		$table->string('phone');

	});
	echo "Đã tạo bảng thành công";
});


//queryBuilder

Route::get('qb/get', function(){
	$data = DB::table('users')->get();
	//var_dump($data);
	foreach($data as $row)
	{
		foreach($row as $key =>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}
});

Route::get('qb/where', function(){
	$data = DB::table('users')->where('id','=',2)->get();
	//var_dump($data);
	foreach($data as $row)
	{
		foreach($row as $key =>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}
});

//select id, name,email...

Route::get('pb/select', function(){
	$data = DB::table('users')->select(['id','name','email'])->where('id',2)->get();
	foreach($data as $row)
	{
		foreach($row as $key =>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}
});


//Câu lệnh truy vấn select name as HoTen...

Route::get('qb/raw', function(){
	$data = DB::table('users')->select(DB::raw('name as hoten'))->where('id',2)->get();
	foreach($data as $row)
	{
		foreach($row as $key =>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}
});


Route::get('qb/update', function(){
	DB::table('users')->where('id',1)->update(['name'=>'Doremon']);
	echo "Đã update";
});


Route::get('qb/delete', function(){
	DB::table('users')->where('id','=',1)->delete();
	echo "Đã xóa";
});


//Model
//
Route::get('model/save', function(){
	$user = new App\User();
	$user->name = "Mai";
	$user->email = "Mai@email.com";
	$user->password = "Mat khau";

	$user->save();

	echo "Đã thực hiện save";
});


Route::get('model/query', function(){
	$user = App\User::find(4);
	echo $user->name;
});


Route::get('model/thongtin/save/{email}', function($email){
	$sanpham = new App\SanPham();
	$sanpham->email = $email;
	$sanpham->phone = "0987653256";

	$sanpham->save();

	echo "Đã thực hiện lệnh save ".$email;
});

Route::get('model/thongtin/all', function(){
	$sanpham = App\SanPham::all()->toArray();
	var_dump($sanpham);
});


Route::get('model/sanpham/ten', function(){
	$sanpham = App\SanPham::where('email','k@gmail.com')->get()->toArray();
	echo $sanpham[0]['email'];
});

Route::get('model/sanpham/delete', function(){
	App\SanPham::destroy(1);
});

