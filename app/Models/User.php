<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use id;
use App\Models\Order;
use App\Models\Favorite;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'additional_phone',
        'email',
        'password',
        'code',
        'image',
    ];

    protected $appends = ['image_path'];

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
        'password' => 'hashed',
    ];



    public function firebase_tokens()
    {
        return $this->hasMany(FirebaseToken::class, 'user_id', 'id');
    }

    public function updateUserDevice()
    {
        if (request()->device_id) {
            // $this->firebase_tokens()->updateOrCreate([
            //     'device_id' => request()->device_id,
            //     'token_firebase' => request()->token_firebase,
            // ]);


            $this->firebase_tokens()->where('device_id', request()->device_id)->delete();

            // Store the new token
            $this->firebase_tokens()->create([
                'device_id' => request()->device_id,
                'token_firebase' => request()->token_firebase,
            ]);
        }
    }

    public function sendEmailVerificationCode()
    {
        $this->update([
            'code' => $this->activationCode(),
        ]);

       //  sendMail($this->code, $this->email, $this->name);

        return true;
    }

    private function activationCode()
    {
        return 1234; //for testing
        return mt_rand(1111, 9999);
    }

    // public function getNameAttribute()
    // {
    //     return $this->fname . ' ' . $this->lname;
    // }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }
    public function address()
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'user_id', 'id');
    // }
    public function cart()
    {
        return $this->hasOne(Order::class ,'user_id','id')->where('type', 'cart');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->where('type', 'order');
    }



}
