<?php

namespace App\Http\Controllers;

use App\Models\DriversLicense;
use App\Models\Ownership;
use Illuminate\Http\Request;

class OwnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownerships = Ownership::all();

        return view('components.ownerships', compact('ownerships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ownership = Ownership::create($request->only(['firstname', 'lastname', 'cpf']));

        $drivers_licence = new DriversLicense();
        $drivers_licence->fill($request->only(['cnh', 'issue_date']));
        $drivers_licence->ownership_id = $ownership->id;
        $drivers_licence->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ownership  $ownership
     * @return \Illuminate\Http\Response
     */
    public function show(Ownership $ownership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ownership  $ownership
     * @return \Illuminate\Http\Response
     */
    public function edit(Ownership $ownership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ownership  $ownership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ownership $ownership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ownership  $ownership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ownership $ownership)
    {
        //
    }
}
