<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLogs extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'search_term',
        'ip_address',
        'searched_at',
    ];
}
