<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\inertia;
use App\Models\User;

use function Termwind\render;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $pageTitle = $users[0]->title??'';
        $metaDescription = $users[0]->description??'';
        $metaKeywords = $users[0]->description??'';        
        return Inertia::render('Users/UsersListing', compact('users'))->withViewData([
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
