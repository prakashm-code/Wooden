<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

use App\DataTables\PlanDataTable;
use App\DataTables\PlywoodDataTable;
use App\Models\Plywood;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class PlywoodController extends Controller
{
    public function index(PlywoodDataTable $DataTable)
    {
        $title = 'Plywood';
        $page = 'admin.plywood.list';
        $js = ['validate'];


        return $DataTable->render('layouts.layout', compact('title', 'page', 'js'));
    }
    public function add()
    {
        $title = 'Add Plywood';
        $page = 'admin.plywood.add';
        $js = ['validate'];

        return view("layouts.layout", compact(
            'title',
            'page',
            'js'
        ));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'nullable|numeric|min:0',
            'market_price' => 'nullable|numeric|min:0',
        ]);

        try {
            $menu                = new Plywood();
            $menu->name          = $validated['name'];
            $menu->price         = $validated['price'];
            $menu->market_price  = $validated['market_price'];

            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;

                $uploadPath = public_path('admin/uploads/plywoods/');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $file->move($uploadPath, $filename);
                $menu->image = $filename;
            }

            $menu->save();

            return redirect()->route('plywoods')->with('msg_success', 'Plywood added successfully!');
        } catch (QueryException $e) {
            return redirect()->back()->with('msg_error', 'Plywood not added: ' . $e->getMessage());
        }
    }

    public function delete(String $id)
    {
        try {
            $menu = Plywood::findOrFail(decrypt($id)); // because you encrypted id
            $menu->delete();
            return response()->json([
                'success' => true,
                'message' => 'Plywood deleted successfully'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Delete failed'
            ], 500);
        }
    }
    public function edit(String $id)
    {
        $id = decrypt($id);

        $title = 'Edit Plywood';
        $page = 'admin.plywood.edit';
        $js = ['validate'];
        $data = Plywood::findOrFail($id);
        return view("layouts.layout", compact(
            'title',
            'page',
            'js',
            'data'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $id = decrypt($id);
            $menu = Plywood::findOrFail($id);
            $validated = $request->validate([
                'name'          => 'required|string|max:255',
                'price'    => 'required|numeric|min:0',
                'market_price' => 'nullable|numeric|min:0',
            ]);

            $menu->name          = $validated['name'];
            $menu->price    = $validated['price'];
            $menu->market_price  = $validated['market_price'];

            if ($request->hasFile('image')) {
                if ($menu->image) {
                    $oldImagePath = public_path('admin/uploads/plywoods/' . $menu->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $file      = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename  = time() . '.' . $extension;

                $uploadPath = public_path('admin/uploads/plywoods/');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $file->move($uploadPath, $filename);
                $menu->image = $filename;
            }
            $menu->save();

            return redirect()->route('menus')->with('msg_success', 'Plywood edited successfully!');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('msg_error', 'Plywood not Updated' . $e->getMessage());
        }
    }
}
