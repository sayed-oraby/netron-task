<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class WebsiteLog extends Model
{
    protected $fillable = [
        'message', 'file', 'line', 'trace', 'url', 'body', 'ip'
    ];


}
