<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model FairAddress
 * Represents a `Feira-Livre` address.
 *
 * @author Nick Moraes <contato@nickgomes.dev>
 *
 * @version 1.0
 *
 * @access public
 *
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class FairAddress extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'number', 'street', 'neighborhood', 'reference_point',
        'longitude', 'latitude', 'district_id', 'census_area_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = [
        'district_id', 'census_area_id', 'created_at',
        'updated_at', 'deleted_at',
    ];

    /**
     * Get the district associated with the fair address.
     *
     * @return HasOne
     */
    public function district(): HasOne
    {
        return $this->hasOne(
            related: District::class,
            foreignKey: 'id',
            localKey: 'district_id'
        );
    }

    /**
     * Get the census area associated with the district.
     *
     * @return HasOne
     */
    public function censusArea(): HasOne
    {
        return $this->hasOne(
            related: CensusArea::class,
            foreignKey: 'id',
            localKey: 'census_area_id'
        );
    }
}
