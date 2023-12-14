<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teams(){
        return $this->belongsToMany(Team::class,'team_employee')->withTimestamps();
    }

    public function team(): BelongsTo{
        return $this->belongsTo(Team::class);
    }

}
