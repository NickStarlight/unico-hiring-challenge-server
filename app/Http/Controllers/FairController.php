<?php

namespace App\Http\Controllers;

use Exception;

use App\Http\Requests\CreateFairsRequest;
use App\Http\Requests\GetFairsRequest;
use App\Http\Requests\UpdateFairsRequest;
use App\Http\Resources\FairCollection;
use App\Http\Resources\FairResource;
use App\Models\Fair;
use App\Models\FairAddress;
use Illuminate\Support\Facades\DB;

/**
 * FairController
 * Encapsulates all CRUD logic for fairs.
 * 
 * @author Nick Moraes <contato@nickgomes.dev>
 * @version 1.0
 * @access public
 * @license https://creativecommons.org/licenses/by-nc/4.0/
 */
class FairController extends Controller
{
    /**
     * Display all the available fairs.
     *
     * @return FairCollection
     */
    public function index(GetFairsRequest $request): FairCollection
    {
        $fairs = Fair::allRelations()
            ->FilterByFairName($request->query('name'))
            ->simplePaginate(10);

        return new FairCollection($fairs);
    }

    /**
     * Store a newly created fair in the database.
     * 
     * @param CreateFairsRequest $request The sanitized and validated request
     * @return FairResource The newly created fair data
     */
    public function store(CreateFairsRequest $request)
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            /** Store the address first */
            $fairAddress = new FairAddress();
            $fairAddress->fill($data['address']);
            $fairAddress->saveOrFail();

            /** Then store the fair with the address ID */
            $fair = new Fair();
            $fair->fill($data);
            $fair->address_id = $fairAddress->id;
            $fair->saveOrFail();

            DB::commit();

            return new FairResource(Fair::allRelations()->findOrFail($fair->id));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified fair.
     *
     * @param int $id The resource ID
     * @return FairResource
     */
    public function show(int $id): FairResource
    {
        return new FairResource(Fair::allRelations()->findOrFail($id));
    }

    /**
     * Update the specified fair in the database.
     *
     * @param UpdateFairsRequest $request The sanitized and validated request
     * @param Fair $fair The referenced Fair by the parameter ID
     * @return FairResource The updated fair data
     */
    public function update(UpdateFairsRequest $request, Fair $fair): FairResource
    {
        $data = $request->all();

        try {
            DB::beginTransaction();

            $fair->fill($data);
            $fair->address->fill($data['address']);
            $fair->saveOrFail();
            $fair->address->saveOrFail();

            DB::commit();

            return new FairResource(Fair::allRelations()->findOrFail($fair->id));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified fair from database.
     *
     * @param Fair $fair
     * @return void
     */
    public function destroy(int $id): void
    {
        Fair::findOrFail($id)->delete();
    }
}
