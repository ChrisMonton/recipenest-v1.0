<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    use Notifiable;


    protected $with = ['user'];


    // =============== RELATIONSHIPS ===============
    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // =============== SCOPES ===============
    /**
     * Undocumented function
     *
     * @param Builder $query
     * @param string $id
     * @return void
     */
    public function scopeList(Builder $query, string $id)
    {
        return true;
    }



    // =============== FUNCTIONS ===============



}
