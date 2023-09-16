<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\Contracts\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'displayName',
        'phone',
        'email',
        'localId'
    ];

    public function getAuthIdentifierName()
    {
        return 'localId';
    }

    public function getAuthIdentifier()
    {
        return $this->localId;
    }
}
