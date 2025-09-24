<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $categories = Category::all();
    //     $posts = Post::latest()->get();
    //     return view('back.post.index', compact('posts', 'categories'));
    // }
    public function index(Request $request)
{
    $categories = Category::all();
    
    // Query dasar
    $posts = Post::with('category')->latest();
    
    // Filter berdasarkan kategori
    if ($request->has('category_filter') && $request->category_filter != '') {
        $posts->where('category_id', $request->category_filter);
    }
    
    // Filter berdasarkan status
    if ($request->has('status_filter') && $request->status_filter != '') {
        $posts->where('status', $request->status_filter);
    }
    
    // Pencarian berdasarkan judul
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $posts->where('title', 'like', '%' . $search . '%');
    }
    
    // Pagination dengan 3 data per halaman
    $posts = $posts->paginate(3);
    
    // Menambahkan parameter filter ke pagination links
    if ($request->has('category_filter') || $request->has('status_filter') || $request->has('search')) {
        $posts->appends([
            'category_filter' => $request->category_filter,
            'status_filter' => $request->status_filter,
            'search' => $request->search
        ]);
    }
    
    // Jika request AJAX, return JSON
    if ($request->ajax()) {
        return response()->json([
            'posts' => view('back.post.partials.posts_table', compact('posts'))->render()
        ]);
    }
    
    return view('back.post.index', compact('posts', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $previousUrl = url()->previous(); // Ambil URL sebelumnya
        // Simpan URL index post saat ini
        session()->put('post_index_url', url()->previous());

        $categories = Category::all();
        // $previousUrl = request()->headers->get('referer') ?: route('post.index'); // Ambil URL Referer
        return view('back.post.create', compact('categories', 'previousUrl'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // simpan gambar ke storage/app/public/posts
            $filePath = Storage::disk('public')->put('posts', request()->file('image'));
            $validated['image'] = $filePath;
        }

        Post::create($validated);

        Swal::success([
            'title' => 'Data berhasil disimpan',
            'showConfirmButton' => false,
            'timer' => 2500,
        ]);

        // Kembali ke URL index yang disimpan
        return redirect(session()->get('post_index_url', route('post.index')));
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
    public function edit(Post $post)
    {
        $categories = Category::all();
        $previousUrl = url()->previous(); // Ambil URL sebelumnya
        return view('back.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // hapus image lama
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }    
            // simpan image baru
            $filePath = Storage::disk('public')->put('posts', $request->file('image'));
            $validated['image'] = $filePath;
        }

        $post->update($validated);

        Swal::success([
            'title' => 'Data berhasil diperbarui',
            'showConfirmButton' => false,
            'timer' => 2500,
        ]);

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Simpan URL sebelumnya sebelum menghapus
    $previousUrl = url()->previous();
    
    // Pastikan URL sebelumnya adalah dari index post (bukan dari halaman lain)
    if (str_contains($previousUrl, route('post.index'))) {
        session()->put('post_index_url', $previousUrl);
    }

    // hapus gambar dari storage
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    Swal::success([
        'title' => 'Data berhasil dihapus',
        'showConfirmButton' => false,
        'timer' => 2500,
    ]);

    // Redirect ke URL yang disimpan atau default index
    return redirect(session()->get('post_index_url', route('post.index')));
    }
}
