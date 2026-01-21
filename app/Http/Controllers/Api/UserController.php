<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
<<<<<<< HEAD
            $query = User::members()->select([
=======
            $authUser = auth()->user();

            // ✅ Admin-only access
            if (! $authUser || $authUser->role !== 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 403);
            }

            $query = User::query()->select([
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                'id',
                'name',
                'email',
                'phone_number',
                'address',
                'school_registration_number',
                'fraternity_number',
                'status',
                'role',
                'rejection_reason',
                'created_at',
                'updated_at',
<<<<<<< HEAD
                'email_verified_at'
            ]);

            // Filter by status
            if ($request->has('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search by name, email, or phone
            if ($request->has('search') && !empty($request->search)) {
=======
                'email_verified_at',
            ]);

            // Filter by status
            if ($request->filled('status') && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            // Search
            if ($request->filled('search')) {
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%")
<<<<<<< HEAD
                        ->orWhere('address', 'like', "%{$search}%");
=======
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhere('school_registration_number', 'like', "%{$search}%")
                        ->orWhere('fraternity_number', 'like', "%{$search}%");
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                });
            }

            $perPage = $request->get('per_page', 15);
            $users = $query->latest()->paginate($perPage);

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'data' => $users
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching users', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
=======
                'data' => $users,
            ]);

        } catch (\Throwable $e) {
            Log::error('Error fetching users', [
                'error' => $e->getMessage(),
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users',
<<<<<<< HEAD
                'error' => $e->getMessage()
=======
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ], 500);
        }
    }

    public function show($id)
    {
        try {
<<<<<<< HEAD
            $user = User::members()
=======
            $user = User::users()
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                ->select([
                    'id',
                    'name',
                    'email',
                    'phone_number',
                    'address',
                    'school_registration_number',
                    'fraternity_number',
                    'status',
                    'role',
                    'rejection_reason',
                    'created_at',
                    'updated_at',
<<<<<<< HEAD
                    'email_verified_at'
                ])
                ->find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
=======
                    'email_verified_at',
                ])
                ->find($id);

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
                ], 404);
            }

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'data' => $user
=======
                'data' => $user,
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching user', [
                'user_id' => $id,
<<<<<<< HEAD
                'error' => $e->getMessage()
=======
                'error' => $e->getMessage(),
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user',
<<<<<<< HEAD
                'error' => $e->getMessage()
=======
                'error' => $e->getMessage(),
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
<<<<<<< HEAD
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,approved,rejected,deactivated',
            'rejection_reason' => 'required_if:status,rejected,deactivated|string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::members()->find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $updateData = [
                'status' => $request->status,
            ];

            // If rejected or deactivated, save reason
            if (in_array($request->status, ['rejected', 'deactivated']) && $request->rejection_reason) {
                $updateData['rejection_reason'] = $request->rejection_reason;
            } else {
                // Clear rejection reason for approved status
                $updateData['rejection_reason'] = null;
            }

            $user->update($updateData);

            Log::info('User status updated', [
                'user_id' => $user->id,
                'old_status' => $user->getOriginal('status'),
                'new_status' => $request->status,
                'reason' => $request->rejection_reason,
                'updated_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User status updated successfully',
                'data' => $user->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating user status', [
                'user_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function statistics(Request $request)
    {
        try {
            $stats = [
                'total' => User::members()->count(),
                'pending' => User::members()->pending()->count(),
                'approved' => User::members()->approved()->count(),
                'rejected' => User::members()->where('status', 'rejected')->count(),
                'deactivated' => User::members()->deactivated()->count(),
=======
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected,deactivated',
            'rejection_reason' => 'nullable|required_if:status,rejected,deactivated|string',
        ]);

        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $user->update([
            'status' => $validated['status'],
            'rejection_reason' => in_array($validated['status'], ['rejected', 'deactivated'])
                ? $validated['rejection_reason']
                : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully',
            'data' => $user->fresh(),
        ]);
    }

    public function statistics()
    {
        try {
            $stats = [
                'total' => User::users()->count(),
                'pending' => User::users()->pending()->count(),
                'approved' => User::users()->approved()->count(),
                'rejected' => User::users()->where('status', 'rejected')->count(),
                'deactivated' => User::users()->deactivated()->count(),
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ];

            return response()->json([
                'success' => true,
                'data' => $stats,
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching user statistics', [
<<<<<<< HEAD
                'error' => $e->getMessage()
=======
                'error' => $e->getMessage(),
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics',
<<<<<<< HEAD
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
=======
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
>>>>>>> b6db75c0efd4d913bf471492ff3bfb841d2b9966
