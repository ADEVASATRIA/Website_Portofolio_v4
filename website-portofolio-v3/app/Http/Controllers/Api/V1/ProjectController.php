<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        // return ProjectResource::collection(Project::all());
        $projects = Project::all();

        return response()->json([
            'message' => 'All Project That Save in Database',
            'data' => $projects
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('projects', 'public');

            // Create a new project with the validated data
            $project = Project::create([
                'skill_id' => $validatedData['skill_id'],
                'name' => $validatedData['name'],
                'image' => $imagePath,
                'project_url' => $validatedData['project_url']
            ]);

            return response()->json([
                'message' => 'Project created successfully!',
                'data' => $project
            ]);
        }

        return response()->json([
            'message' => 'Image file is required.'
        ], 400);
    }

    public function update(StoreProjectRequest $request, $id)
    {
        // Validate the request
        $validatedData = $request->validated();

        // Find the project by ID
        $project = Project::findOrFail($id);

        // Update the project with the validated data
        $project->update($validatedData);

        return response()->json([
            'message' => 'Project updated successfully!',
            'data' => $project
        ]);
    }

    public function destroy($id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);

        // Delete the project
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully!'
        ]);
    }
}





