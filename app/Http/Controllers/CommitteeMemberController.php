<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CommitteeMemberController extends BaseController
{
    public function index(Committee $committee)
    {
        $members = $committee->members;
        return view('backend.committee_members.index', compact('committee', 'members'));
    }

    public function create(Committee $committee)
    {
        return view('backend.committee_members.create', compact('committee'));
    }

    public function store(Request $request, Committee $committee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
            'sort_order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('committee-members', 'public');
        }

        $committee->members()->create($data);

        return redirect()->route('admin.committees.members.index', $committee)->with('success', 'Member added successfully.');
    }

    public function edit(Committee $committee, CommitteeMember $member)
    {
        return view('backend.committee_members.edit', compact('committee', 'member'));
    }

    public function update(Request $request, Committee $committee, CommitteeMember $member)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048',
            'sort_order' => 'required|integer',
        ]);

        if ($request->hasFile('image_file')) {
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = $request->file('image_file')->store('committee-members', 'public');
        }

        $member->update($data);

        return redirect()->route('admin.committees.members.index', $committee)->with('success', 'Member updated successfully.');
    }

    public function destroy(Committee $committee, CommitteeMember $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();
        return redirect()->route('admin.committees.members.index', $committee)->with('success', 'Member removed successfully.');
    }
}
