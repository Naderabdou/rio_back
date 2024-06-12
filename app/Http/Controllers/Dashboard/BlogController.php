<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogsRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $blogRepository;


    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('dashboard.blogs.index', compact('blogs'));
    }
    public function create()
    {
        return view('dashboard.blogs.create');
    }
    public function store(BlogsRequest $request)
    {


        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', transWord('تم اضافه الخبر بنجاح'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('dashboard.blogs.edit', compact('blog'));
    }


    public function update(BlogsRequest $request, $id)
    {
        $data = $request->validated();
        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', transWord('تم تعديل الخبر بنجاح'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);


        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        //   $this->categoryRepository->delete($request->id);
        $blog->delete();

        return \response()->json([
            'message' => 'تم الحذف بنجاح',
        ]);
    }

    public function show($id)
    {
        return \redirect()->route('admin.blogs.index');
    }
}
