<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawlerResult extends Model
{
    use HasFactory;

    protected $table = 'crawler_results';

    protected $fillable = [
        'screenshot',
        'title',
        'description',
        'body',
    ];

    public const UPDATED_AT = null;
}
