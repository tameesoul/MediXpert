<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'local',
    ];
    public $primarykey = 'user_id';
    public function user()
    {
        return $this->belongsTo(User::class,"user_id",'id');
    }
}
