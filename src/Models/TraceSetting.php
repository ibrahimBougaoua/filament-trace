<?php

namespace IbrahimBougaoua\FilamentTrace\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraceSetting extends Model
{
    use HasFactory;

    protected $table = 'filament_trace_settings';

    protected $fillable = [
        'key',
        'truncate',
        'stop',
    ];

    protected $attributes = [
        'truncate' => false,
        'stop' => true,
    ];
}
