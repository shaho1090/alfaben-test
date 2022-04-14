<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferStoreRequest;
use App\Http\Resources\TransferResource;
use App\InternalServices\Transfer\CreateNewTransfer;
use App\Models\Transfer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * @throws \Exception
     */
    public function store(TransferStoreRequest $request): JsonResponse
    {
        $request = $request->toArray();
        $request['registrant_id'] = auth()->id();

        try{
            DB::beginTransaction();

            $transfer = (new CreateNewTransfer(new Transfer(),$request))->handle();

            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        return response()->json([
            'data' => new TransferResource($transfer)
        ]);
    }
}
