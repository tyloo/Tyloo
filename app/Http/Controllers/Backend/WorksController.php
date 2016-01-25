<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\Work;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $works = Work::all();

        return view('backend.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkRequest $request)
    {
        $this->saveWork($request->all());

        return redirect()->route('admin.works.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $work = Work::findOrFail($id);

        return view('backend.works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);

        return view('backend.works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkRequest $request
     * @param int         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkRequest $request, $id)
    {
        $this->saveWork($request->all(), $id);

        return redirect()->route('admin.works.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete($id);

        return redirect()->route('admin.works.index');
    }

    /**
     * @param array        $data
     * @param integer|null $id
     */
    protected function saveWork(array $data = [], $id = null)
    {
        // Image Handling
        if (isset($data['image'])) {
            $data['image'] = $this->buildImage($data['slug'], $data['image']);
        }

        // We create the Work
        if ($id === null) {
            $data['author_id'] = Auth::id();
            Work::create($data);
        } else {
            Work::findOrFail($id)->update($data);
        }
    }

    /**
     * Build the image.
     *
     * @param string       $slug
     * @param UploadedFile $image
     *
     * @return string
     */
    protected function buildImage($slug, $image)
    {
        $filePath = '/uploads/' . $slug . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(public_path($filePath));

        return $filePath;
    }
}
