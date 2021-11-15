<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $appends = ['username', 'time'];

    protected $fillable = ['content'];

    public function getUsernameAttribute()
    {
        return "unknown";
    }

    public function getTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

}
