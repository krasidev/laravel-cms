<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreProjectRequest;
use App\Http\Requests\Backend\UpdateProjectRequest;
use App\Models\Project;
use App\Repository\Backend\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    private $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->data($request->all());
        }

        return view('backend.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Backend\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->repository->create($request->only(['name', 'slug', 'url', 'short_description', 'description']));

        if ($request->hasFile('image')) {
            $imagePath = public_path(Project::IMAGE_PATH);

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true);
            }

            $basename = $project->id . '.' . $request->image->extension();
            $request->image->move($imagePath, $basename);

            $project->update([
                'image' => $basename
            ]);
        }

        return redirect()->route('backend.projects.index')
            ->with('success', [
                'title' => __('messages.backend.projects.store_success.title'),
                'text' => __('messages.backend.projects.store_success.text')
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->repository->find($id);

        return view('backend.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Backend\UpdateProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $data = $request->only(['name', 'slug', 'url', 'short_description', 'description']);

        if ($request->hasFile('image')) {
            $imagePath = public_path(Project::IMAGE_PATH);

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0777, true);
            }

            $data['image'] = $id . '.' . $request->image->extension();
            $request->image->move($imagePath, $data['image']);
        }

        $this->repository->update($data, $id);

        return redirect()->route('backend.projects.index')
            ->with('success', [
                'title' => __('messages.backend.projects.update_success.title'),
                'text' => __('messages.backend.projects.update_success.text'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return $this->repository->restore($id);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }

    /**
     * Reorder the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        return $this->repository->reorder($request->all());
    }
}
