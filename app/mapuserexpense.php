<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mapuserexpense extends Model
{
    protected $table = 'mapuserexpense';
    protected $fillable = ['expense_id', 'user_id'];
    
    public function expense()
    {
        return $this->belongsTo('App\expense', 'expense_id', 'id');
    }
}
