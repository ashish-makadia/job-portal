<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Application::with(['job', 'user']);

            if ($request->has('job_id') && $request->job_id) {
                $query->where('job_id', $request->job_id);
            }

            if ($request->has('user_id') && $request->user_id) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->has('status') && $request->status) {
                $query->where('status', $request->status);
            }

            $applications = $query->paginate(15);

            return response()->json([
                'success' => true,
                'data' => $applications->items(),
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error fetching applications: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch applications',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(ApplicationRequest $request)
    {
        $application = Application::create([
            'user_id' => $request->user()->id,
            'job_id' => $request->job_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'status' => $request->status,
        ]);

        return new ApplicationResource($application->load(['job', 'user']));
    }

    public function show(Application $application)
    {
        return new ApplicationResource($application->load(['job', 'user']));
    }

    public function update(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'cover_letter' => 'sometimes|required|string',
        ]);

        $application->update($request->only([
            'status',
            'name',
            'email',
            'phone',
            'cover_letter',
        ]));

        return new ApplicationResource($application->load(['job', 'user']));
    }

    public function destroy(Application $application)
    {
        $application->delete();

        return response()->json([
            'message' => 'Application deleted successfully'
        ]);
    }
}