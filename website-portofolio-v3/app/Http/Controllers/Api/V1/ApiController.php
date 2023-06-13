<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\SkillResource;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('api', ['except' => ['login']]);
    // }
    public function login()
    {
        $credentials = request(['email', 'password']);
        // if (Auth::attempt($credentials)) {
        //     // $user = Auth::user();
        //     // $token = $user->createToken('MyApp')->plainTextToken;
        //     return response()->json(['token' => $token]);
        // }

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
       
        // $validator = Validator::make($request->all(), [
        //     'email'    => 'required',
        //     'password' => 'required'
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
    
        // $credentials = $request->only('email', 'password');
        // if (!$token = auth()->guard('api')->attempt($credentials)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Email atau Password Anda salah'
        //     ], 401);
        // }
    
        // return response()->json([
        //     'success' => true,
        //     'user'    => auth()->guard('api')->user(),
        //     'token'   => $token
        // ], 200);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        //remove token
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function index()
    {
        return SkillResource::collection(Skill::all());
    }

    public function show(Skill $skill)
    {
        return new SkillResource($skill);
    }

    public function store(StoreSkillRequest $request){
        $validatedData = $request->validated();

        $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('skills', 'public');
            $skill = Skill::create([
                'name' => $validatedData['name'],
                'image' => $imagePath
            ]);
        }
        return response()->json([
            'message' => 'Skill created successfully!'
        ]);
    }

    public function destroy(Skill $skill){
        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully!'
        ]);
    }
}
