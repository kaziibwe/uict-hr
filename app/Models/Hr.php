<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





use Illuminate\Contracts\Auth\Authenticatable;

class Hr extends Model
 implements Authenticatable
{
    use HasFactory;

    protected $table = 'hrs'; // Replace with your actual table name

    // Implement the methods required by the Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; // Replace with the name of your unique identifier column (usually 'id').
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // Your model's properties and additional methods go here

    protected $fillable = [
        'name',
        'title',
        'email',
        'staff_number',
        'dob',
        'current_appointment',
        'appointment_date',
        'nin',
        'tin',
        'phone',
        'password',

    ];
}
