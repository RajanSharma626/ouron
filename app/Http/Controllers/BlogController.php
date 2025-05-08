<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs', compact('blogs'));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $products = Product::whereNull('deleted_at')->get();
            return view('admin.blog-edit', compact('blog', 'products'));
        }
        return redirect()->route('admin.blogs')->with('error', 'Blog not found!');
    }

    public function update(Request $request)
    {
        $blog = Blog::find($request->input('id'));
        if (!$blog) {
            return redirect()->route('admin.blogs')->with('error', 'Blog not found!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'blog_content' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        // Handle image uploads
        if ($request->hasFile('banner_image')) {
            Storage::delete($blog->banner_image);
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
            $bannerImagePath = 'blogs/' . $bannerImageName;
            $bannerImage->move(public_path('blogs'), $bannerImageName);
            $blog->banner_image = $bannerImagePath;
        }

        if ($request->hasFile('cover_image')) {
            Storage::delete($blog->cover_image);
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_cover.' . $coverImage->getClientOriginalExtension();
            $coverImagePath = 'blogs/' . $coverImageName;
            $coverImage->move(public_path('blogs'), $coverImageName);
            $blog->cover_image = $coverImagePath;
        }

        // Update blog details
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title) . '-' . uniqid();
        $blog->short_desc = $request->short_desc;
        $blog->blog_content = $request->blog_content;
        $blog->product_id = $request->product_id;
        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            Storage::delete($blog->banner_image);
            Storage::delete($blog->cover_image);
            $blog->delete();
            return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully');
        }
        return redirect()->route('admin.blogs')->with('error', 'Blog not found!');
    }

    public function homeIndex()
    {
        $blogs = Blog::all();
        return view('frontend.blogs', compact('blogs'));
    }

    public function create()
    {
        $products = Product::whereNull('deleted_at')->get();
        return view('admin.blog-create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_desc' => 'required|string|max:500',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'blog_content' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        // Upload images directly to public folder
        $bannerImage = $request->file('banner_image');
        $coverImage = $request->file('cover_image');

        $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
        $coverImageName = time() . '_cover.' . $coverImage->getClientOriginalExtension();

        $bannerImagePath = 'blogs/' . $bannerImageName;
        $coverImagePath = 'blogs/' . $coverImageName;

        $bannerImage->move(public_path('blogs'), $bannerImageName);
        $coverImage->move(public_path('blogs'), $coverImageName);

        // Create Blog record
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'short_desc' => $request->short_desc,
            'banner_image' => $bannerImagePath,
            'cover_image' => $coverImagePath,
            'blog_content' => $request->blog_content,
            'product_id' => $request->product_id,
        ]);

        // Generate Blog URL
        $blogUrl = url('/blog/' . $blog->slug);

        // Generate QR Code, save it in public folder directly
        $qrCodeDir = public_path('qrcodes');
        if (!file_exists($qrCodeDir)) {
            mkdir($qrCodeDir, 0755, true);
        }
        $qrCodeName = 'blog_' . $blog->id . '.svg';
        $qrCodePath = 'qrcodes/' . $qrCodeName;
        file_put_contents(public_path($qrCodePath), QrCode::format('svg')->size(200)->generate($blogUrl));

        // Update blog with QR code path
        $blog->update(['qr_code' => $qrCodePath]);

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully');
    }


    public function show($slug)
    {
        $blog = Blog::with('product')
            ->where('slug', operator: $slug)->firstOrFail();
        return view('frontend.blog-detail', compact('blog'));
    }
}
