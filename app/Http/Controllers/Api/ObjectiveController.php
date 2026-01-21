<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Models\Objective;
=======
use App\Models\MissionAndVision;
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

<<<<<<< HEAD
class ObjectiveController extends Controller
{
    /**
     * Display the objectives data (Public)
=======
class MissionAndVisionController extends Controller
{
    /**
     * Display the mission and vision data (Public)
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public function index()
    {
        try {
<<<<<<< HEAD
            $objective = Objective::first();

            if (!$objective) {
                return response()->json([
                    'success' => false,
                    'message' => 'No objectives data found',
=======
            $missionVision = MissionAndVision::first();

            if (!$missionVision) {
                return response()->json([
                    'success' => false,
                    'message' => 'No mission and vision data found',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'data' => $objective,
                'message' => 'Objectives data retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching objectives data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch objectives data',
=======
                'data' => $missionVision,
                'message' => 'Mission and vision data retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching mission and vision data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch mission and vision data',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
<<<<<<< HEAD
     * Display the objectives data for admin
=======
     * Display the mission and vision data for admin
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public function show()
    {
        try {
<<<<<<< HEAD
            $objective = Objective::first();

            if (!$objective) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'No objectives data found'
=======
            $missionVision = MissionAndVision::first();

            if (!$missionVision) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'No mission and vision data found'
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                ], 200);
            }

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'data' => $objective,
                'message' => 'Objectives data retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching objectives data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch objectives data',
=======
                'data' => $missionVision,
                'message' => 'Mission and vision data retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching mission and vision data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch mission and vision data',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
<<<<<<< HEAD
     * Store or update objectives data
=======
     * Store or update mission and vision data
     * - If table is empty: create new record
     * - If record exists with blank mission and vision columns: update it
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
<<<<<<< HEAD
                'objectives_header' => 'required|string|max:255',
                'objectives_title' => 'required|string|max:255',
                'objectives_description' => 'required|string',
                'objectives_card_title' => 'required|array',
                'objectives_card_title.*' => 'required|string|max:255',
                'objectives_card_content' => 'required|array',
                'objectives_card_content.*' => 'required|string',
=======
                'mission_and_vision_header' => 'required|string|max:255',
                'mission_and_vision_title' => 'required|string|max:255',
                'mission_and_vision_description' => 'required|string',
                'mission_content' => 'required|string',
                'vision_content' => 'required|string',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $data = [
<<<<<<< HEAD
                'objectives_header' => $request->objectives_header,
                'objectives_title' => $request->objectives_title,
                'objectives_description' => $request->objectives_description,
                'objectives_card_title' => json_encode($request->objectives_card_title),
                'objectives_card_content' => json_encode($request->objectives_card_content),
            ];

            $existingRecord = Objective::first();

            if (!$existingRecord) {
                $objective = Objective::create($data);
                $message = 'Objectives data created successfully';
            } else {
                $existingRecord->update($data);
                $objective = $existingRecord->fresh();
                $message = 'Objectives data updated successfully';
=======
                'mission_and_vision_header' => $request->mission_and_vision_header,
                'mission_and_vision_title' => $request->mission_and_vision_title,
                'mission_and_vision_description' => $request->mission_and_vision_description,
                'mission_content' => $request->mission_content,
                'vision_content' => $request->vision_content,
            ];

            $existingRecord = MissionAndVision::first();

            if (!$existingRecord) {
                // Table is empty, create new record
                $missionVision = MissionAndVision::create($data);
                $message = 'Mission and vision data created successfully';
            } else {
                // Record exists, update it
                $existingRecord->update($data);
                $missionVision = $existingRecord->fresh();
                $message = 'Mission and vision data updated successfully';
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            }

            DB::commit();

<<<<<<< HEAD
            // Parse JSON back to arrays for response
            $objective->objectives_card_title = json_decode($objective->objectives_card_title, true);
            $objective->objectives_card_content = json_decode($objective->objectives_card_content, true);

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $objective
=======
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $missionVision
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

<<<<<<< HEAD
            Log::error('Error storing objectives', [
=======
            Log::error('Error storing mission and vision', [
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
<<<<<<< HEAD
                'message' => 'Failed to store objectives data',
=======
                'message' => 'Failed to store mission and vision data',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
<<<<<<< HEAD
     * Update the objectives data in storage
=======
     * Update the mission and vision data in storage
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
<<<<<<< HEAD
            'objectives_header' => 'required|string|max:255',
            'objectives_title' => 'required|string|max:255',
            'objectives_description' => 'required|string',
            'objectives_card_title' => 'required|array',
            'objectives_card_title.*' => 'required|string|max:255',
            'objectives_card_content' => 'required|array',
            'objectives_card_content.*' => 'required|string',
=======
            'mission_and_vision_header' => 'required|string|max:255',
            'mission_and_vision_title' => 'required|string|max:255',
            'mission_and_vision_description' => 'required|string',
            'mission_content' => 'required|string',
            'vision_content' => 'required|string',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = [
<<<<<<< HEAD
                'objectives_header' => $request->objectives_header,
                'objectives_title' => $request->objectives_title,
                'objectives_description' => $request->objectives_description,
                'objectives_card_title' => json_encode($request->objectives_card_title),
                'objectives_card_content' => json_encode($request->objectives_card_content),
            ];

            $objective = Objective::first();

            if (!$objective) {
                $objective = Objective::create($data);
                $message = 'Objectives created successfully';
            } else {
                $objective->update($data);
                $message = 'Objectives updated successfully';
=======
                'mission_and_vision_header' => $request->mission_and_vision_header,
                'mission_and_vision_title' => $request->mission_and_vision_title,
                'mission_and_vision_description' => $request->mission_and_vision_description,
                'mission_content' => $request->mission_content,
                'vision_content' => $request->vision_content,
            ];

            $missionVision = MissionAndVision::first();

            if (!$missionVision) {
                // If no record exists, create one
                $missionVision = MissionAndVision::create($data);
                $message = 'Mission and vision created successfully';
            } else {
                // Update existing record
                $missionVision->update($data);
                $message = 'Mission and vision updated successfully';
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            }

            DB::commit();

<<<<<<< HEAD
            // Parse JSON back to arrays for response
            $objective->objectives_card_title = json_decode($objective->objectives_card_title, true);
            $objective->objectives_card_content = json_decode($objective->objectives_card_content, true);

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $objective
=======
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $missionVision
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

<<<<<<< HEAD
            Log::error('Objectives update error', [
=======
            Log::error('Mission and vision update error', [
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
<<<<<<< HEAD
     * Remove the objectives data from storage
=======
     * Remove the mission and vision data from storage
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
     */
    public function destroy()
    {
        try {
<<<<<<< HEAD
            $objective = Objective::first();

            if (!$objective) {
                return response()->json([
                    'success' => false,
                    'message' => 'No objectives data found'
=======
            $missionVision = MissionAndVision::first();

            if (!$missionVision) {
                return response()->json([
                    'success' => false,
                    'message' => 'No mission and vision data found'
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                ], 404);
            }

            DB::beginTransaction();

<<<<<<< HEAD
            $objective->update([
                'objectives_header' => null,
                'objectives_title' => null,
                'objectives_description' => null,
                'objectives_card_title' => null,
                'objectives_card_content' => null,
=======
            // Only clear mission and vision fields, don't delete the record
            $missionVision->update([
                'mission_and_vision_header' => null,
                'mission_and_vision_title' => null,
                'mission_and_vision_description' => null,
                'mission_content' => null,
                'vision_content' => null,
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'message' => 'Objectives data cleared successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error clearing objectives data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear objectives data',
=======
                'message' => 'Mission and vision data cleared successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error clearing mission and vision data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear mission and vision data',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'error' => $e->getMessage()
            ], 500);
        }
    }
}