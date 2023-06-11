<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Project; // Add this line
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Project index'
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());

        return response()->json([
            'message' => 'Project created successfully!'
        ]);
    }
}
