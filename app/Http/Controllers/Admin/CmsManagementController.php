<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsManagementController extends Controller
{

    public function cms($slug)
    {
        $cms = CmsPage::where('slug', $slug)->first();
        return view('dealer.cms_page', compact('cms'));
    }
    public function index()
    {
        $cms_pages = CmsPage::get();
        return view('admin.cms.index', compact('cms_pages'));
    }
    public function edit(CmsPage $page)
    {
        return view('admin.cms.edit', compact('page'));
    }
    public function update(Request $request, CmsPage $page)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required',
        ], [
            'name.required' => 'Please enter the name',
            'content.required' => 'Please enter the content',
            'image.required' => 'Please enter the image',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->image;
            if (isset($page->media_url)) {
                Storage::disk('public')->delete('cms_pics', $page->media_url);
            }
            $media_name = $file->getClientOriginalName();
            $path = Storage::disk('public')->put('cms_pics', $file);
        }

        $page->update([
            'name' => $request->name,
            'slug' => $page->slug,
            'page_content' => $request->content,
            'page_title' => $request->page_title,
            'media_name' => $media_name,
            'media_url' => $path,
            'status' => $request->status == '1' ? '1' : '0',
        ]);

        $url = route('admin.cms.index');
        session()->flash('status', 'Page updated successfully');
        return redirect()->route('admin.cms.index');
        // return response()->json(['success' => true, 'status' => 'success', 'message' => 'Page updated successfully', 'url' => $url]);
    }
    // public function toggleStatus(Request $request)
    // {
    //     $id = $request->id;
    //     try {
    //         $class = "App\Models\\{$request->model}";

    //         if (empty($class)) {
    //             return response()->json(['status' => 'error', 'message' => ucwords($request->model) . ' not found'], 404);
    //         }
    //         $result = $class::where('id', $id)->firstOrFail();
    //         $status = ($result->status == 1) ? '0' : '1';

    //         if ($result->update(['status' => $status])) {
    //             if ($status == '1') {
    //                 return response()->json(['status' => 'success', 'message' => $request->model . " has been activated"], 200);
    //             } else {
    //                 return response()->json(['status' => 'danger', 'message' => $request->model . " has been deactivated"], 200);
    //             }
    //         } else {
    //             return response()->json(['status' => 'error', 'message' => 'status' . ' has not been updated.'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
    //     }
    // }
}
