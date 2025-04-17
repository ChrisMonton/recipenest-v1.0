<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    // Define fillable fields so you can use mass-assignment.
    protected $fillable = [
        'user_id',
        'experience',
        'education',
        'interests',
        'specialties',
    ];

    /**
     * Define the relationship to the user.
     * Each portfolio belongs to one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
