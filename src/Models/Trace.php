<?php

namespace IbrahimBougaoua\FilamentTrace\Models;

use App\Models\User;
use IbrahimBougaoua\FilamentTrace\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    use HasFactory,Multitenantable;

    protected $table = 'filament_trace';

    protected $fillable = [
        "name",
        "model",
        "content",
        "action",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
