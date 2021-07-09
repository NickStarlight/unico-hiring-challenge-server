<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model CensusSector
 * Represents a `Setor Censitário`.
 *
 * @author Nick Moraes <contato@nickgomes.dev>
 *
 * @version 1.0
 *
 * @access public
 *
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class CensusSector extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = ['census_area_id', 'created_at', 'updated_at', 'deleted_at'];
}
