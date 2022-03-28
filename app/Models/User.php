<?php

namespace App\Models;

use App\Mail\PasswordSetMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;
    use Notifiable;
    protected $table = "Users";
    protected $primaryKey = 'U_Serial';
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'U_Password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'U_LogIn' => 'datetime',
        'U_LogOut' => 'datetime',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function is_permitted_to($name, $class_name, $request)
    {
        if (isset($class_name::$controllable)) {
            if (isset($class_name::$field_to_check)) {
                $model = null;
                $field = $class_name::$field_to_check;
                $params = Route::current()->parameters();
                $model = reset($params);
                if ($request->id) {
                    $model = $class_name::find($request->id);
                }
                if (!$model) {
                    $p_name = $class_name::getSubName($request->$field);
                } else {
                    $p_name = $class_name::getSubName($model->$field);
                }
            } else {
                return true;
            }
            if (!$this->current_role)
                return true;
            $permission = $this->current_role->permissions()->where('code', '=', $p_name)->first();
            if (!$permission)
                return true;
            $p = $name;
            return $permission->$p;
        }
        return true;
    }
    public function getIsAdminAttribute()
    {
        return $this->role == 1;
    }
    public static function createRules($user)
    {
        return [
            'name' => 'required',
            'user_name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'status' => 'somtimes|integer',
            'password' => 'required|min:6',
        ];
    }
    public static function updateRules($request, $user)

    {
        if ($request['password']) {
            return [
                'old_password' => 'current_password:api',
                'password' => 'required|min:6',
                'confirm_password' => 'required_with:password|same:password|min:6',
            ];
        }
        return [
            'user_name' => 'required',
            'mobile' => 'required|unique:users,mobile,' . $user->id,

        ];
    }
    public function scopeSearch($query, $request)
    {
    }
    public function scopeSort($query, $request)
    {
        $query->when($request->email, function ($q, $email) {
            $q->where('email', '=', $email);
        });
    }
    public function getWaiterIdAttribute(){
        return request('waiter_id');
    }
    public function waiters(){
        return $this->hasMany(Waiter::class,'WTR_UserID');
    }
    
}
