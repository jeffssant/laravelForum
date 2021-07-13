<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply',
        'user_id',
        'thread_id',
    ];

    public function thread(){
       return $this->BelongsTo(Thread::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
