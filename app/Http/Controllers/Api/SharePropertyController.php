<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\AgentProperty;
use App\Models\ShareProperty;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSharePropertyRequest;
use App\Http\Resources\GroupedSharedPropertyResource;

class SharePropertyController extends Controller
{
    public function shareProperty(StoreSharePropertyRequest $request)
    {
        try {
            $agent = auth('agent_api')->user();

            if (!$agent) {
                return response()->json([
                    'status' => false,
                    'message' => 'Authentication failed. Unauthorized access.',
                ], 401);
            }

            $propertyIds = $request->property_id;
            $properties = AgentProperty::whereIn('id', $propertyIds)
                ->where('agent_id', $agent->id)
                ->get();

            if ($properties->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No valid properties found for this agent.',
                ], 404);
            }

            foreach ($properties as $property) {
                ShareProperty::create([
                    'agent_id'    => $agent->id,
                    'client_id'   => $request->client_id,
                    'role'        => $request->role,
                    'property_id' => $property->id,
                    'status'      => $request->status ?? 'pending',
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Properties shared successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while sharing the property.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // public function getSharedProperty(Request $request)
    // {
    //     try {
    //         $agent = auth('agent_api')->user();
    //         if (!$agent) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Authentication failed. Unauthorized access.',
    //             ], 401);
    //         }

    //         $clientId = $request->client_id;

    //         if (!$clientId) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Client ID is required.',
    //             ], 400);
    //         }

    //         $sharedProperties = ShareProperty::with(['property', 'client.documents'])
    //             ->where('agent_id', $agent->id)
    //             ->where('client_id', $clientId)
    //             ->get()
    //             ->groupBy('client_id');

    //         if ($sharedProperties->isEmpty()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'No shared properties found.',
    //             ], 200);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Shared properties retrieved successfully.',
    //             'data' => GroupedSharedPropertyResource::collection($sharedProperties->values()),
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'An unexpected error occurred while fetching the shared properties.',
    //             'error' => $th->getMessage(),
    //         ], 500);
    //     }
    // }



    public function getSharedProperty(Request $request)
    {
        try {
            $agent = auth('agent_api')->user();
            if (!$agent) {
                return response()->json([
                    'status' => false,
                    'message' => 'Authentication failed. Unauthorized access.',
                ], 401);
            }

            $clientId = $request->client_id;

            if (!$clientId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client ID is required.',
                ], 400);
            }

            $client = Client::with('documents')
                ->where('id', $clientId)
                ->where('agent_id', $agent->id)
                ->first();

            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Client not found.',
                ], 404);
            }

            $sharedProperties = ShareProperty::with(['property'])
                ->where('agent_id', $agent->id)
                ->where('client_id', $clientId)
                ->get();

            $grouped = collect([
                $sharedProperties->isNotEmpty()
                    ? $sharedProperties->map(function ($item) use ($client) {
                        $item->setRelation('client', $client);
                        return $item;
                    })
                    : collect([
                        tap(new ShareProperty, fn($item) => $item->setRelation('client', $client))
                    ])
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Shared properties retrieved successfully.',
                'data' => GroupedSharedPropertyResource::collection($grouped),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred while fetching the shared properties.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
