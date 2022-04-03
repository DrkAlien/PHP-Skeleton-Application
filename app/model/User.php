<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';
    protected $fillable = ['first_name', 'last_name','email','password','gender','active','plan'];

    public function userPlan() {
       return $this->hasOne('\App\Model\UserPlan', 'id', 'plan');
    }
}