<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.manage', compact('blogs'));
    }

    public function view() {
        $blogs = Blog::with(['votes', 'user'])->get();
        return view('blogs.view', compact('blogs'));
    }

    public function add(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'user_email' => 'required|email',
        ]);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->body = $validatedData['body'];
        $blog->user_email = $validatedData['user_email'];
        $blog->save();
    
        return redirect('/blogs/manage');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect('/blogs/manage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Blog::create($request->all());

        return redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function applyEdit(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->save();

        return redirect('/blogs/manage');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update($request->all());

        return redirect()->route('blogs.index');
    }


    public function manage(Request $request)
    {
        $userEmail = $request->user()->email;
        $blogs = Blog::where('user_email', $userEmail)->get();
        return view('blogs.manage', compact('blogs'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}