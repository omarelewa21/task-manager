<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public static function findOrCreateForUser($name, $user)
    {
        return static::firstOrCreate([
            'name' => $name,
            'user_id' => $user->id,
        ]);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('priority');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
