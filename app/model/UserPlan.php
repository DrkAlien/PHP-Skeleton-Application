<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model {

    protected $table = 'user_plans';
    protected $fillable = ['slug','label','price'];


}