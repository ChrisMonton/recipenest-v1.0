<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\DatabaseNotification;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'surname',
        'email',
        'password',
        'profile',
        'date_of_birth',
        'profile_picture',
        'bio',
        'role',
        'short_description',
        'full_description',
        'address',
        'phone',
        'bio',
        'profile_picture',
        'specialties',
        'social_facebook',
        'social_x',
        'social_instagram',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // =============== RELATIONSHIPS ===============

    /**
     * Get all of the recipes for the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    // =============== SCOPES ===============

    public function scopeList(Builder $query)
    {
        $query->where('id', '>', 0)
            ->withCount(['recipes as total_recipes'])
            ->latest();
    }

    public function scopeAuthor(Builder $query, $id)
    {
        $query->where('id', $id);
    }

    // =============== FUNCTIONS ===============

    /**
     * Get the link to view the chef's profile.
     *
     * @return string
     */
    public function getLink()
    {
        return route('chefs.show', ['id' => $this->id]);
    }

    /**
     * Get the link to view the chef's portfolio.
     *
     * @return string
     */
    public function getPortfolioLink()
    {
        return route('chefs.portfolio.show', ['id' => $this->id]);
    }

    /**
     * Get the profile image URL.
     *
     * @return string
     */
    public function getImage()
    {
        return asset('storage/' . $this->profile);
    }

    /**
     * Accessor to retrieve the user's name.
     *
     * This returns the first_name field.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return ucfirst($this->first_name);
    }
}
