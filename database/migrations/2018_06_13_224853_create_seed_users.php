<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateSeedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        User::create([
        	'name' => 'admin',
        	'email'	=>	'admin@admin.com',
        	'password' => Hash::make('1234')
        ]);
    }

}
