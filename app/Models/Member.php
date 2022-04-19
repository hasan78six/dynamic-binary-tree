<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'sponsor_id',
        'position'
    ];

    public function children()
    {
        return $this->hasMany(static::class, 'sponsor_id')->orderBy('position', 'ASC')->with(["children"]);
    }
}
