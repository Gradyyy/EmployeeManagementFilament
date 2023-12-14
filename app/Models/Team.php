<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employees(){
        return $this->belongsToMany(Employee::class,'team_employee')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class,'team_user')->withTimestamps();
    }

    public function members(){
        return $this->belongsToMany(User::class);
    }


}
