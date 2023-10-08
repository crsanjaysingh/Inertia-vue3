<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;



class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = BlogPost::all();
        $pageTitle = $blogs[0]->title;
        $metaDescription = $blogs[0]->description;
        $metaKeywords = $blogs[0]->description;        
        return Inertia::render('BlogsIndex', compact('blogs'))->withViewData([
            'title' => $pageTitle,
            'metaDescription' => $metaDescription,
            'metaKeywords' => $metaKeywords,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        

        return Inertia::render('AddBlog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:15|max:2000',
        ]);        

        $data =  array(
            'title' => $request->title,
            'description' => $request->description,
        );

        $Blog = BlogPost::create($data);
        if($Blog){            
            return redirect()->route('blogs')->with('success', 'Blog is added !');
        }else{
            return Redirect::back()->with('error', 'Failed to add blog.');
        }                      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = BlogPost::find($id);
        return Inertia::render('BlogsUpdate',[
            'formData' => $blog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {        
        $request->validate([
            'id' => 'required',
            'title' => 'required|min:3|max:200',
            'description' => 'required|min:15|max:2000',
        ]);           
        $blog = BlogPost::find($request->id);
        if($blog){            
            $blog->title = $request->title;
            $blog->description =  $request->description;
            $blog->save();
            return Redirect::back()->with('success', 'Blog updated.');
        }else{
            return Redirect::back()->with('error', 'Blog failed to update.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = BlogPost::findOrFail($id);
        if($blog->delete()){
            return Redirect::back()->with('success', 'Blog Deleted.');                
        }else{
            return Redirect::back()->with('error', 'Failed to Delete.');      
        }        
    }
}
