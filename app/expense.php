<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    protected $table = 'expense';
    
    public function shared_by_users()
    {
        return $this->hasMany('App\mapuserexpense', 'expense_id', 'id');
    }
    
}
