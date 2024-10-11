<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApacheLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'date',
        'time',
        'http_method',
        'request_url',
        'http_protocol',
        'status_code',
        'response_size',
        'user_agent'
    ];
}
