<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model CensusArea
 * Represents a `Area de ponderação`.
 * 
 * @author Nick Moraes <contato@nickgomes.dev>
 * @version 1.0
 * @access public
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class CensusArea extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the Census Sector that contains the Census Area.
     * 
     * @return BelongsTo
     */
    public function censusSector(): BelongsTo
    {
        return $this->belongsTo(related: CensusSector::class, foreignKey: 'id', ownerKey: 'census_area_id');
    }
}
