<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends BaseController
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        return view('backend.team_members.index', compact('members'));
    }

    public function create()
    {
        return view('backend.team_members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:leadership,coordinator',
            'image_file' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('team-members', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('backend.team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:leadership,coordinator',
            'image_file' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $data['image'] = $request->file('image_file')->store('team-members', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }
        $teamMember->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
