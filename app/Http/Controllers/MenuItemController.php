<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rule;

class MenuItemController extends BaseController
{
    private const ZONES = ['about', 'join_us', 'topics'];

    public function index(Request $request)
    {
        $zone = $request->string('zone')->toString();
        if (! in_array($zone, self::ZONES, true)) {
            $zone = 'about';
        }

        $items = MenuItem::query()
            ->zone($zone)
            ->roots()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(50)
            ->withQueryString();

        return view('backend.menu-items.index', compact('items', 'zone'));
    }

    public function create(Request $request)
    {
        $zone = $request->string('zone')->toString();
        if (! in_array($zone, self::ZONES, true)) {
            $zone = 'about';
        }

        return view('backend.menu-items.create', compact('zone'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['sort_order'] = (int) (MenuItem::query()->zone($data['zone'])->roots()->max('sort_order') + 1);
        $data['is_active'] = $request->boolean('is_active', true);
        MenuItem::create($data);

        return redirect()
            ->route('admin.menu-items.index', ['zone' => $data['zone']])
            ->with('success', 'Menu link created.');
    }

    public function edit(MenuItem $menu_item)
    {
        return view('backend.menu-items.edit', ['item' => $menu_item]);
    }

    public function update(Request $request, MenuItem $menu_item)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'href' => 'nullable|string|max:2048',
            'action' => 'nullable|string|max:64|in:openModal',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $menu_item->update($data);

        return redirect()
            ->route('admin.menu-items.index', ['zone' => $menu_item->zone])
            ->with('success', 'Menu link updated.');
    }

    public function destroy(MenuItem $menu_item)
    {
        $zone = $menu_item->zone;
        $menu_item->delete();

        return redirect()
            ->route('admin.menu-items.index', ['zone' => $zone])
            ->with('success', 'Menu link removed.');
    }

    private function validated(Request $request, bool $withZone = false): array
    {
        $rules = [
            'label' => 'required|string|max:255',
            'href' => 'nullable|string|max:2048',
            'action' => 'nullable|string|max:64|in:openModal',
        ];
        if ($withZone) {
            $rules['zone'] = ['required', Rule::in(self::ZONES)];
        }

        return $request->validate($rules);
    }
}
