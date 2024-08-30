<?php 

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use App\Auth\Admin as Authenticatable;

class Admin extends Authenticatable
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
