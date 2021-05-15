<?php

namespace App\Http\Controllers;

use App\Models\DriversLicense;
use App\Models\Ownership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $drivers_license = new DriversLicense();
        $drivers_license->fill($request->only(['cnh', 'issue_date']));
        $drivers_license->ownership_id = $ownership->id;
        $drivers_license->save();

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
        $ownership->fill($request->only(['firstname', 'lastname', 'cpf']));
        $ownership->save();

        $ownership->drivers_license->fill($request->only(['cnh', 'issue_date']));
        $ownership->drivers_license->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ownership  $ownership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ownership $ownership)
    {
        $ownership->delete();

        return back();
    }
}
