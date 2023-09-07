<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'end_date', 'user_id'];
    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
