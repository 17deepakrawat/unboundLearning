<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Blog;
use App\Models\Website\WebsiteContent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
  public function index()
  {
    $blogs = Blog::all();
    return view('website.blogs.index', compact('blogs'));
  }

  public function frontIndex()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $blogs = Blog::orderBy('created_at', 'desc')->get();
    $allBlogContent = Blog::pluck('content');
    $tagArr = [];
    foreach($allBlogContent as $content)
    {
        $jsonData = json_decode($content,true);
        if(!empty(json_decode($jsonData['populartag'],true)))
        {
          foreach(json_decode($jsonData['populartag'],true) as $tag)
          {
            $tagArr [] = $tag['value'];
          }
        }
    }
    return view('website.forms.blogs', compact('blogs', 'pageConfigs','tagArr'));
  }

  public function view($slug)
  {
    try
    {
      $pageConfigs = ['myLayout' => 'front'];
      $blogDetails = Blog::where('slug', $slug)->with('comments')->first();
      $blogSuccessTalkContent = WebsiteContent::where('slug','/blogs-success-talk')->where('name','Blogs')->first();
      $blogAdBannerContent = WebsiteContent::where('slug','/blogs-ad-banner')->where('name','Blogs')->first();
      $tags = !empty($blogDetails->content) ? json_decode($blogDetails->content, true)['meta'] : array();
      return view('website.forms.blog_details', compact('blogDetails', 'pageConfigs', 'tags','blogSuccessTalkContent','blogAdBannerContent'));
    }
    catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }

  public function create()
  {
    return view('website.blogs.create');
  }

  public function store(Request $request)
  {
    try {
      $blog = new Blog;
      $content = $request->content;
      if (isset($content['image_section_1'])) {
        $path = 'assets/blog/section/images';
        $newFileName = rand() . time() . '.' . $content['image_section_1']->extension();
        $content['image_section_1']->move(public_path($path), $newFileName);
        $images = $path . '/' . $newFileName;
        $content['image_section_1'] = $images;
      }
      if (isset($content['images']) && count($content['images']) > 0) {
        $path = 'assets/blog/images';
        foreach ($content['images'] as $key => $image) {
          $newFileName = rand() . time() . '.' . $image->extension();
          $image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $content['images'][$key] = $images;
        }
      }
      if ($request->hasFile('author_image')) {
        $path = 'assets/blog/author/images';
          $newFileName = rand() . time() . '.' . $request->author_image->extension();
          $request->author_image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $blog->author_image = $images;
      }
      if (isset($content['imagecollection']) && count($content['imagecollection']) > 0) {
        $path = 'assets/blog/imagecollection/images';
        foreach ($content['imagecollection'] as $key => $image) {
          $newFileName = rand() . time() . '.' . $image->extension();
          $image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $content['imagecollection'][$key] = $images;
        }
      }
      $images = !empty($blog->images) ? json_decode($blog->images, true) : array();
      if ($request->hasFile('banner_image')) {
        $path = 'assets/blog/banner_image/images';
        $newFileName = time() . rand() . '.' . $request->banner_image->extension();
        $request->banner_image->move(public_path($path), $newFileName);
        $images[$key] = $path . '/' . $newFileName;
      }
      $blog->content = json_encode($content);
      $blog->images = json_encode($images);
      $blog->name = $request->name;
      $blog->type = $request->type;
      $blog->author = $request->author;
      $blog->slug = Str::slug($request->name);
      $blog->save();
      return response()->json([
        'status' => 'success',
        'message' => $blog->name . ' updated successfully!',
      ]);
    } catch (Exception $e) {
      return response()->json(['status' => 'success',
        'message' => $e->getMessage()
      ]);
    }
  }

  public function edit($slug)
  {
    $blog = Blog::where('slug', $slug)->first();
    return view('website.blogs.edit', compact('blog'));
  }

  public function update(Request $request, $id)
  {
    try {
      $blog = Blog::findOrFail($id);
      $content = !empty($blog->content) ? json_decode($blog->content, true) : [];
      if (isset($request->content['image_section_1'])) {
        $path = 'assets/blog/section/images';
        $newFileName = rand() . time() . '.' . $request->content['image_section_1']->extension();
        $request->content['image_section_1']->move(public_path($path), $newFileName);
        $images = $path . '/' . $newFileName;
        $content['image_section_1'] = $images;
      }
      if (isset($request->content['images']) && count($request->content['images']) > 0) {
        $path = 'assets/blog/images';
        foreach ($request->content['images'] as $key => $image) {
          $newFileName = rand() . time() . '.' . $image->extension();
          $image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $content['images'][$key] = $images;
        }
      }
      if ($request->hasFile('author_image')) {
        $path = 'assets/blog/author/images';
          $newFileName = rand() . time() . '.' . $request->author_image->extension();
          $request->author_image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $blog->author_image = $images;
      }
      if (isset($request->content['imagecollection']) && count($request->content['imagecollection']) > 0) {
        $path = 'assets/blog/imagecollection/images';
        foreach ($request->content['imagecollection'] as $key => $image) {
          $newFileName = rand() . time() . '.' . $image->extension();
          $image->move(public_path($path), $newFileName);
          $images = $path . '/' . $newFileName;
          $content['imagecollection'][$key] = $images;
        }
      }
      $images = !empty($blog->images) ? json_decode($blog->images, true) : array();
      if ($request->hasFile('banner_image')) {
        $path = 'assets/blog/banner_image/images';
        $newFileName = time() . rand() . '.' . $request->banner_image->extension();
        $request->banner_image->move(public_path($path), $newFileName);
        $images[$key] = $path . '/' . $newFileName;
      }
      $content['populartag'] = $request->content['populartag'];
      $blog->content = json_encode($content);
      $blog->images = json_encode($images);
      $blog->name = $request->name;
      $blog->type = $request->type;
      $blog->author = $request->author;
      $blog->slug = Str::slug($request->name);
      $blog->save();
      return response()->json([
        'status' => 'success',
        'message' => $blog->name . ' updated successfully!',
      ]);
    } catch (Exception $e) {
      return response()->json(['status' => 'success',
        'message' => $e->getMessage()
      ]);
    }
  }

  public function blogList(Request $request)
  {
    if($request->input('query')!='')
    {
      $blogs = Blog::where('content', 'LIKE', '%'.$request->input('query').'%')->orWhere('name','LIKE', '%'.$request->input('query').'%')->get();
    }
    else
    {
      $blogs = Blog::all();
    }
    $allBlogContent = Blog::pluck('content');
    $tagArr = [];
    foreach($allBlogContent as $content)
    {
        $jsonData = json_decode($content,true);
        if(!empty(json_decode($jsonData['populartag'],true)))
        {
          foreach(json_decode($jsonData['populartag'],true) as $tag)
          {
            $tagArr [] = $tag['value'];
          }
        }
    }
    return view('website.forms.blog_list', compact('blogs','tagArr'));
  }

  public function createAdBanner()
  {
      $content = WebsiteContent::where('slug','/blogs-ad-banner')->where('name','Blogs')->first();
      return view('website.blogs.adbanner',compact('content'));
  }

  public function storeAdBanner(Request $request)
  {
    try{
      $blogContent = WebsiteContent::where('slug','/blogs-ad-banner')->where('name','Blogs')->first();
      $content = !empty($blogContent->content) ? json_decode($blogContent->content, true) : array();
      $adBanners = array_key_exists('ad_banner', $content) ? $content['ad_banner'] : array();
      if (array_key_exists('ad_banner', $request->content)) {
        foreach ($request->content['ad_banner'] as $key => $values) {
          if (array_key_exists('image', $values)) {
            $path = 'assets/img/universities/adbanner';
            if (!File::exists(public_path($path))) {
              File::makeDirectory(public_path($path), 0777);
            }

            $path = $path . '/' . $request->id;
            if (!File::exists(public_path($path))) {
              File::makeDirectory(public_path($path), 0777);
            }

            $newFileName = $key . '.' . $values['image']->extension();
            $values['image']->move(public_path($path), $newFileName);
            $adBanners[$key]['image'] = $path . '/' . $newFileName;
            $adBanners[$key]['url'] = $values['url'];
          } else {
            $adBanners[$key]['url'] = $values['url'];
            $adBanners[$key]['image'] = $adBanners[$key]['image'];
          }
        }
      }
      $content['ad_banner'] = $adBanners;
      $contents = WebsiteContent::updateOrCreate(['slug' => '/blogs-ad-banner', 'name' => 'Blogs'], ['content' => json_encode($content)]);
      return response()->json([
        'status' => 'success',
        'message' => 'Ad banner added',
      ]);
    }
    catch(Exception $e)
    {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
  public function createSuccessTalk()
  {
      $content = WebsiteContent::where('slug','/blogs-success-talk')->where('name','Blogs')->first();
      return view('website.blogs.success-talk',compact('content'));
  }

  public function storeSuccessTalk(Request $request)
  {
    try{
      $contents = WebsiteContent::updateOrCreate(['slug' => '/blogs-success-talk', 'name' => 'Blogs'], ['content' => json_encode($request->content)]);
      return response()->json([
        'status' => 'success',
        'message' => 'ASuccess Talk added',
      ]);
    }
    catch(Exception $e)
    {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }

  public function search(Request $request)
  {
          $title = $request->input('title');
          $courses = Blog::search($title)->get();
          if (!$courses->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $courses]);
        } else {
          
            return response()->json(['status' => 404, 'data' => []]);
        }
  }
}
