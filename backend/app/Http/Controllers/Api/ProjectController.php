<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //get all published projects
    public function index(){
        $projects = Project::published()
        ->ordered()
        ->get();
        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }
    //get featured projects only
    public function featured(){
        $projects =Project::published()
        ->featured()
        ->ordered()
        ->get();

        return response()->json([
            'success' => true,
            'data' => $projects,
        ]);
    }

    //get single project by slug
    public function show($slug)
{
    $project = Project::where('slug', $slug)
        ->published()
        ->first();

    if (!$project) {
        return response()->json([
            'success' => false,
            'message' => 'Project not found or not published'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $project
    ]);
}

}
