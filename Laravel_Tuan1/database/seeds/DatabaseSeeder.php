<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
        $this->call(userSeeder::class);
    }
}



class userSeeder extends Seeder
{
	public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
        DB::table('users')->insert([
        	['name'=>'Teo','email'=>str_random(3),'password'=>bcrypt('matkhau')],
        	['name'=>'Ti','email'=>str_random(3),'password'=>bcrypt('matkhau')], 
        	['name'=>'Tun','email'=>str_random(3),'password'=>bcrypt('matkhau')]
        ]);
    }
}
