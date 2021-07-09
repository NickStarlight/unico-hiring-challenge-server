<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model Fair
 * Represents a `Feira-Livre`.
 * 
 * @author Nick Moraes <contato@nickgomes.dev>
 * @version 1.0
 * @access public
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class Fair extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['name', 'pmsp_code'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = ['address_id', 'created_at', 'updated_at', 'deleted_at'];

    /** 
     * Bootstrap the model and its traits.
     */
    public static function boot()
    {
        parent::boot();

        /** Delete the address when the fair is deleted */
        static::deleting(function ($fair) {
            $fair->address()->delete();
        });
    }


    /**
     * Get the address associated with the fair.
     * 
     * @return BelongsTo
     */
    public final function address()
    {
        return $this->hasOne(related: FairAddress::class, foreignKey: 'id', localKey: 'address_id');
    }

    /**
     * Return the fairs with all pertinent relations.
     * Those relations are: FairAddress, District, Borough,
     * CensusSector and CensusArea.
     * 
     * @param Builder $query The Builder context
     * @return Builder
     */
    public final function scopeAllRelations(Builder $query): Builder
    {
        return $query->with([
            'address',
            'address.district',
            'address.district.borough',
            'address.censusArea',
            'address.censusArea.censusSector'
        ]);
    }

    /** 
     * Filter Fairs by a specific fair name.
     * 
     * @param Builder $query The Builder context
     * @param string $name The name for filtering
     */
    public final function scopeFilterByFairName(Builder $query, ?string $name): Builder
    {
        if ($name) {
            return $query->where('name', $name);
        }

        return $query;
    }
}
