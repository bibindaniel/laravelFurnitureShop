<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function submitBlogForm(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'content' => 'required|string',
            ]);

            // Associate the blog with the currently authenticated user
            $user_id = auth()->user()->id;

            $imagePath = $request->file('image')->store('blog_images', 'public');

            Blog::create([
                'title' => $validatedData['title'],
                'user_id' => $user_id, // Associate the blog with the user
                'image' => $imagePath,
                'content' => $validatedData['content'],
            ]);

            return back()->with('success', 'Blog submitted successfully!');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error submitting blog: ' . $e->getMessage());

            // Optionally, you can return to the previous page with an error message
            return back()->with('error', 'Error submitting blog. Please try again.');
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('editblog', compact('blog'));
    }


    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
        ]);

        // Update the blog post fields
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image (if exists)
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Upload and store the new image
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }

        // Save the updated blog post
        $blog->save();

        return back()->with('success', 'Blog updated successfully!');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        // Delete the blog post
        $blog->delete();

        $blog = Blog::all();
        return view('blog')->with('item', $blog);
    }
}
