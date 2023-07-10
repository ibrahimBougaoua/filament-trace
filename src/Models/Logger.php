<?php

namespace IbrahimBougaoua\FilamentTrace\Models;

use App\Models\User;
use IbrahimBougaoua\FilamentTrace\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory,Multitenantable;

    const LOGOUT = 'Log Out';

    const LOGGEDIN = 'Logged In';

    protected $table = 'filament_logger';

    protected $fillable = [
        'name',
        'country_code',
        'country_name',
        'city',
        'postal',
        'latitude',
        'longitude',
        'IPv4',
        'state',
        'browser',
        'system',
        'device',
        'action',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
