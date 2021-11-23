<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeToWebsiteRequest;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubscribeToWebsite extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\SubscribeToWebsiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SubscribeToWebsiteRequest $request, int $id)
    {
        $requestBody = $request->validated();

        try {
            $website = Website::find($id);

            if (!$website) {
                return response()->json([
                    'message' => 'Website not found',
                    'status' => 'error',
                ], Response::HTTP_NOT_FOUND);
            }

            $website->subscribers()->attach($requestBody['user_id']);

            return response()->json([
                'website' => $website,
                'subscriber' => $requestBody['user_id'],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
