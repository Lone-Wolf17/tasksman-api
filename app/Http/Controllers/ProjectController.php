<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    // !! Return all Projects that are not yet completed ordered by date created
    // !! Along with tasks under each project that are yet to be completed
    public function index () {

        $projects = Project::where('is_completed', false)
            ->orderBy('created_at', 'desc')
            ->withCount(['tasks' => function($query) {
            $query->where('is_completed', false);
        }])->get();

        return $projects->toJson();
    }

    // !! Create and Store a new Project
    public function store (Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return $project->toJson();
    }

    // !! Fetch Project & it's child tasks from DB
    public function show($id) {
        $project = Project::with(['tasks' => function ($query) {
            $query->where('is_completed', false);
        }])->find($id);

        return $project->toJson();
    }

    // !! Mark passed project as completed
    public function markAsCompleted(Project $project) {
        $project->is_completed = true;
        $project->update();

        return response()->json('Project updated!');

    }
}
