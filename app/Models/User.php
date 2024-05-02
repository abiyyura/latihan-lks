<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table ="users";
    protected $primaryKey="int";
    protected $casts=[
        'is_private'=>'boolean'
    ];
    protected $fillable=[
     'full_name',
     'username',
     'password',
     'bio'

    ];
    public $incrementing =true;
    public $timestamps=true;
}
