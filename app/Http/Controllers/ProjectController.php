<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
	/**
     * Validate the request attributes
     *
     * @return array
     */
    protected function validateProject(){

        return request()->validate([
            'name' => 'required | min:3 | max:255',
            'description' => 'required | min:3 | max:100'
        ]);

    }

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    	return view('projects.create', [
    		'projects' => Project::all()
    	]);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateProject();
        $project = Project::create($attributes);

        return ['message' => 'Project created'];
    }
}
