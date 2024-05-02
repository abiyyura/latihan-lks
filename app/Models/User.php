<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
