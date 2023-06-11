<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request\StoreSkillRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use App\Http\Resources\SkillResource;

class SkillController extends Controller
{
    public function index()
    {
        return SkillResource::collection(Skill::all());
    }

    public function show(Skill $skill)
    {
        return new SkillResource($skill);
    }

    public function store(StoreSkillRequest $request)
    {
        // $validatedData = $request->validated();
        Skill::create($request->validated());

        // Process the validated data and store the skill

        return response()->json([
            'message' => 'Skill created successfully!'
        ]);
    }

    public function update(StoreSkillRequest $request, Skill $skill){
        $skill->update($request->validated());

        return response()->json([
            'message' => 'Skill updated successfully!'
        ]);
    }

    public function destroy(Skill $skill){
        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully!'
        ]);
    }
    
}
