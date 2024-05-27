<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['toSearch'])) {
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(5);
        } else {
            $projects = Project::paginate(5);
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $route = route('admin.projects.store');
        $method = 'POST';
        $title_text = 'Add a new project';
        $project = null;
        $types = Type::orderBy('name')->get();

        return view('admin.projects.create-edit', compact('route', 'method', 'title_text', 'project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        if (array_key_exists('img', $form_data)) {
            $img_path = Storage::put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);

        $new_project = new Project();
        $new_project->fill($form_data);

        $new_project->save();

        return redirect()->route('admin.projects.index')->with('success_msg', 'The project has been successfully included in the list');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $route = route('admin.projects.update', $project);
        $method = 'PUT';
        $title_text = 'Edit project';
        $types = Type::orderBy('name')->get();

        return view('admin.projects.create-edit', compact('route', 'method', 'title_text', 'project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if ($form_data['title'] !== $project->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
        } else {
            $form_data['slug'] = $project->slug;
        }

        if (array_key_exists('img', $form_data)) {
            $img_path = Storage::put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->img) {
            Storage::disk('public')->delete($project->img);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_msg', 'The project ' . $project->title . ' has been successfully removed from the list');
    }
}
