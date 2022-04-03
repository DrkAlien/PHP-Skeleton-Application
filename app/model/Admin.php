<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Admin extends Model {

    protected $table = 'admins';
    protected $fillable = ['first_name','last_name','email','password','role','active'];

    public function adminRole() {
        return $this->hasOne('\App\Model\AdminRole', 'id', 'role');
    }

}