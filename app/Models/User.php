<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Password mutator - Automatically hashes the password before saving
     * This ensures that passwords are always encrypted before storage
     *
     * @param string $value The plain text password
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Phone number mutator - Cleans the phone number to contain only digits
     * Removes any non-numeric characters from the phone number
     *
     * @param string $value The raw phone number input
     * @return void
     */
    public function setPhoneNumberAttribute($value)
    {
        // First clean the number to contain only digits
        $cleanNumber = preg_replace('/[^0-9]/', '', $value);
        
        // If the number has at least 4 digits, insert the hyphen
        if (strlen($cleanNumber) >= 4) {
            $firstPart = substr($cleanNumber, 0, 4);
            $secondPart = substr($cleanNumber, 4);
            $this->attributes['phone_number'] = $firstPart . '-' . $secondPart;
        } else {
            $this->attributes['phone_number'] = $cleanNumber;
        }
    }

    /**
     * Get all of the password history for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
    }
}
