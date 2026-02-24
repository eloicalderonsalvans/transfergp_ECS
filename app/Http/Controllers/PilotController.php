<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilot;
use App\Models\Equip;

class PilotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pilots = Pilot::all();
        return view('pilot.index', compact('pilots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equips = Equip::all();
        return view('pilot.create', compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nom' => 'required|string|max:255',
            'Cognom' => 'required|string|max:255',
            'Nacionalitat' => 'required|string|max:255',
            'Data_neixament' => 'required|date',
            'Numero' => 'required|integer',
            'Foto_url' => 'nullable|url',
            'Mundials_guanyats' => 'required|integer',
            'ID_Equip' => 'required|exists:equips,id',
        ]);

        $data = $request->all();
        $data['Estat_Actiu'] = $request->has('Estat_actiu') ? 1 : 0;

        Pilot::create($data);

        return redirect()->route('pilot.index')->with('success', 'Pilot creat correctament.');
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
        $pilot = Pilot::findOrFail($id);
        $equips = \App\Models\Equip::all();
        return view('pilot.edit', compact('pilot', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nom' => 'required|string|max:255',
            'Cognom' => 'required|string|max:255',
            'Nacionalitat' => 'required|string|max:255',
            'Data_neixament' => 'nullable|date',
            'Numero' => 'required|integer',
            'Foto_url' => 'nullable|url',
            'Mundials_guanyats' => 'nullable|integer',
            'ID_Equip' => 'required|exists:equips,id',
            'Estat_actiu' => 'required|in:0,1',
        ]);

        $pilot = Pilot::findOrFail($id);
        $data = $request->all();
        $data['Estat_actiu'] = $request->input('Estat_actiu');

        $pilot->update($data);

        return redirect()->route('pilot.index')->with('success', 'Pilot actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
