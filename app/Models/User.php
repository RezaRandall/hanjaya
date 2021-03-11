<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function up()
    // {
    //     Schema::create('users', function (BluePrint $table){
    //         $table->increments(id);
    //         $table->string(product_id)->nullable;
    //         $table->string(customer_name)->nullable;
    //         $table->string(phone)->nullable;
    //         $table->string(address)->nullable;
    //         $table->string(item_name)->nullable;
    //         $table->string(qty)->nullable;
    //         $table->string(uom)->nullable;;
    //         $table->string(status);
    //         $table->date(create_on);

    //     });
    // }


}
