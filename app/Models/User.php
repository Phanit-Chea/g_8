<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // User.php

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'gender',
        'address',
        'password',
        'dateOfBirth',
        'profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function store($request, $id = null){
        $data = $request->only(
        'name',
        'email',
        'phone_number',
        'age',
        'gender',
        'address',
        'password',
        'profile');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
    public function food(): HasMany
    {
        return $this->hasMany(Food::class);
    }

}

