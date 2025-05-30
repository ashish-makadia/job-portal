<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('user')->withCount('applications');
    
        if ($request->has('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }
    
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
    
        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
    
        if ($request->filled('salary') && strtolower($request->salary) !== 'any') {
            $salaryFilters = explode(',', $request->salary);
            $query->where(function($q) use ($salaryFilters) {
                foreach ($salaryFilters as $filter) {
                    $filter = trim($filter);
                    if (preg_match('/^(\\d+)-(\\d+)$/', $filter, $matches)) {
                        $min = (int)$matches[1];
                        $max = (int)$matches[2];
                        $q->orWhereBetween('salary', [$min, $max]);
                    } elseif (preg_match('/^(\\d+)\\+$/', $filter, $matches)) {
                        $min = (int)$matches[1];
                        $q->orWhere('salary', '>=', $min);
                    }
                }
            });
        }
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('company', 'like', '%' . $search . '%');
            });
        }
    
        $perPage = $request->get('per_page', 30);
        $jobs = $query->paginate($perPage);
    
        return JobResource::collection($jobs);
    }


    public function store(JobRequest $request)
    {
        $job = Job::create([
            'user_id' => $request->user()->id,
            ...$request->validated()
        ]);

        // SendJobPostedEmail::dispatch($job, $request->user()->email);

        return new JobResource($job->load('user'));
    }

    public function show(Job $job)
    {
        return new JobResource($job->load('user'));
    }

    public function update(JobRequest $request, Job $job)
    {
        $job->update($request->validated());

        return new JobResource($job->load('user'));
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully'
        ]);
    }
}