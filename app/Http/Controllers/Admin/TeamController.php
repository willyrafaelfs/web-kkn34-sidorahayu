<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'position' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('teams', 'public');
        }

        Team::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'position' => $request->position,
            'instagram_link' => $request->instagram_link,
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('admin.teams.index')->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        // Logika update mirip store, tapi cek foto lama
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($team->photo_path) Storage::disk('public')->delete($team->photo_path);
            $data['photo_path'] = $request->file('photo')->store('teams', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.teams.index')->with('success', 'Data anggota diperbarui.');
    }

    public function destroy(Team $team)
    {
        if ($team->photo_path) Storage::disk('public')->delete($team->photo_path);
        $team->delete();
        return redirect()->route('admin.teams.index')->with('success', 'Anggota dihapus.');
    }
}