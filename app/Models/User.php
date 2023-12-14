<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Models\Team;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements HasTenants, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }
    
    
 
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }
    // nyalakan untuk pivot table
    // public function teams(){
    //     return $this->belongsToMany(Team::class,'team_user')->withTimestamps();
    // }

    public function teams(): BelongsToMany{
        return $this->belongsToMany(Team::class);
    }

    public function canAccessPanel(Panel $panel): bool{

        $user = Auth::user();
        $roles = $user->getRoleNames();


        if($panel->getId() === 'admin' && $roles->contains('Manager')){
            return true;
        }
        else if($panel->getId() === 'app' && $roles->contains('Manager')){
            return true;
        }
        else{
            return false;
        }

        return true;
    }

    public function isAdmin(): bool
    {
        return $this->email === 'grady@manager.com';
    }
}
