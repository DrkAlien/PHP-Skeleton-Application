<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model {

    protected $table = 'admin_roles';
    protected $fillable = ['slug','label','permissions'];

    public function rolePermissions() {
        return json_decode($this->permissions,true);
    }

}