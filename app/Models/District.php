<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model District
 * Represents a `Distrito`.
 * 
 * @author Nick Moraes <contato@nickgomes.dev>
 * @version 1.0
 * @access public
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class District extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = ['borough_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Get the borough associated with the district.
     * 
     * @return HasOne
     */
    public function borough()
    {
        return $this->hasOne(related: Borough::class, foreignKey: 'id', localKey: 'borough_id');
    }
}
