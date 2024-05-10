<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('parent')->search()->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $category = new Category;
        $selective = Category::where('status', '1')->where('parent_id', null)->get();
        // dd($selective);

        return view('admin.category.add', compact('category', 'selective'));
    }

    public function store(CategoryRequest $request, $id = null)
    {
        if ($id != null) {
            $id = jsdecode_userdata($id);
        }
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'status' => $request->status,
            ];
            if ($request->has('icon')) {
                $data['icon'] = $request->icon;
            }
            if ($request->has('main_category')) {

                $data['parent_id'] = $request->main_category;
            }

            if ($id == null) {
                Category::create($data);
            } else {
                $category = Category::where('id', $id)->firstOrFail();

                if ($category) {
                    $category->update($data);
                } else {
                    return response()->json([
                        'success'    =>  false,
                        'msg'       =>   "Category not found"
                    ], 200);
                }
            }
            DB::commit();
            if ($id == null) {
                $message = "Category created sucessfully";
            } else {
                $message = "Category updated sucessfully";
            }
            $url = route('admin.category.index');
            session()->flash('success', $message);
            // session()->flash('status', 'success');
            // session()->flash('message', $message);
            return response()->json([
                'success'    =>  true,
                'url'       =>   $url
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success'    =>  false,
                'msg'      =>  $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        if ($id != null) {
            $id = jsdecode_userdata($id);
        }
        $category = Category::where('id', $id)->first();
        $selective = Category::where('status', '1')->where('parent_id', null)->get();
        return view('admin.category.add', compact('category', 'selective'));
    }

    public function destroy($id)
    {
        if ($id != null) {
            $id = jsdecode_userdata($id);
        }
        $category = Category::where('id', $id)->firstOrFail();
        $subcategories = Category::where('parent_id', $id)->get();
        DB::beginTransaction();
        try {
            foreach ($subcategories as $subcategory) {
                Category::where('id', $subcategory->id)->update(['parent_id' => null]);
            }
            $category->delete();
            DB::commit();
            $status = "success";
            $message = "Category deleted sucessfully";
        } catch (\Exception $e) {
            DB::rollback();
            $status = "danger";
            $message = "Category deletion failed";
        }
        return redirect()->route('admin.category.index')->with($status, $message);
    }
}
