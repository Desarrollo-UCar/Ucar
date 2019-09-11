<?php

namespace App;
//namespace App\Notifications;
use App\Role;
use App\Empleado;

//use App\Notifications\ResetPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
{
    abort_unless($this->hasAnyRole($roles), 401);
    return true;
}
public function hasAnyRole($roles)
{
    if (is_array($roles)) {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
    } else {
        if ($this->hasRole($roles)) {
             return true; 
        }   
    }
    return false;
}
public function hasRole($role)
{
    if ($this->roles()->where('name', $role)->first()) {
        return true;
    }
    return false;
}
//--aregado
public function sendPasswordResetNotification($token){
   $this->notify(new ResetPasswordNotification($token));
}

public function nombre(){
   $empleado = Empleado::where('correo','=',$this->email)->first();
   return $empleado->nombres;

}

public function rol(){
    $empleado = User::join('role_user','role_user.user_id','=','users.id')
    ->join('roles','role_user.role_id','=','roles.id')
    ->where('email','=',$this->email)->first();
    return $empleado->description;
 
 }

}
