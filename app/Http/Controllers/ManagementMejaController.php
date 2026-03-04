<?php

namespace App\Http\Controllers;

use App\Models\ManagementMeja;
use Illuminate\Http\Request;

class ManagementMejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('meja.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meja.create');
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
    public function show(ManagementMeja $managementMeja)
    {
        return view('meja.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManagementMeja $managementMeja)
    {
        return view('meja.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManagementMeja $managementMeja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManagementMeja $managementMeja)
    {
        //
    }
}
