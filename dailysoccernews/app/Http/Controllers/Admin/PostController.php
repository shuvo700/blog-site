<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $data=Post::latest()->get();
        return view('admin-panel.post',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::latest()->get();
        $tags=Tag::latest()->get();
        return view('admin-panel.post-create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|min:5|unique:posts,slug,.($id)',
            //'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'categories' => 'required',
            //'tags' => 'required',
            'body' => 'required|min:20',
            ]);
        $post= new Post;
        $post->title= $request['title'];
        function make_slug($string) {
    //return preg_replace('/\s+/u', '-', trim($string));
    $trim_data= preg_replace('/\s+/u', '-', trim($string));
    $lower_data= strtolower($trim_data) ;
    return $lower_data;
    //return strtolower($lower_data);
}
        $post->slug= make_slug($request->title);
        // IMAGE
        if($request->image){
                $destinationPath =   public_path('/images/post');
                $file = $request->image;
                $ext = $request->image->getClientOriginalExtension();
                $fileName =  make_slug($request->title).'.'.$ext;
                if(file_exists($destinationPath.'/'.$fileName)){
                    @unlink($destinationPath.'/'.$fileName);
                }
                $file->move($destinationPath, $fileName);
                $post->image = $fileName;
            }
            else{
                $post->image = 'default.jpg'; 
            }
        // image
        $post->body= $request['body'];
        if(isset($request->status)){
            $post->status=true;
        }
        else{
            $post->status=false;
        }
        // only for admin
        $post->is_approved= 1;
        //$post->user_id= Auth::user()->id;

        $post->user_id=  \Auth::user()->id;

        
        $post->save();
        // category and ppost data goes to pivot table [category_post],[post_tag] table
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        session()->flash('msg', 'Successfully Create Post');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post=Post::find($id);
       return view('admin-panel.post-show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::get();
        $tags=Tag::get();
        return view('admin-panel.post-edit',compact('post','categories','tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'title' => 'required|min:5|unique:posts,slug,.($id)',
            //'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'categories' => 'required',
            //'tags' => 'required',
            'body' => 'required|min:20',
            ]);
        $post= Post::find($id);
        $post->title= $request['title'];
        function make_slug($string) {
            $trim_data= preg_replace('/\s+/u', '-', trim($string));
            $lower_data= strtolower($trim_data) ;
            return $lower_data;
        }
        $post->slug= make_slug($request->title);
        // IMAGE
        if($request->image !=''){
                $destinationPath =   public_path('/images/post');
                $file = $request->image;
                $ext = $request->image->getClientOriginalExtension();
                $fileName =  make_slug($request->title).'.'.$ext;
                if(file_exists($destinationPath.'/'.$fileName)){
                    @unlink($destinationPath.'/'.$fileName);
                }
                $file->move($destinationPath, $fileName);
                $post->image = $fileName;
            }
        // image
        $post->body= $request['body'];
        if(isset($request->status)){
            $post->status=true;
        }
        else{
            $post->status=false;
        }
        // only for admin
        $post->is_approved= 1;
        //$post->user_id= Auth::user()->id;

       // $post->user_id=  \Auth::user()->id; // no need auth id when update

        
        $post->update();
        // category and ppost data goes to pivot table [category_post],[post_tag] table
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        session()->flash('msg', 'Successfully Update Post');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);
        $post->categories()->detach(); // delete with many to many relationship
        $post->tags()->detach();
        // delete image
        $destinationPath =   public_path('/images/post');
        $fileName =  $post->image;
        if(file_exists($destinationPath.'/'.$fileName)){
            @unlink($destinationPath.'/'.$fileName);
        }
        // delete image
        $post->delete();
        return back()->with('msg', 'Post Has Been Delete');
    }
     //pending post
    public function pending(){
        $posts=Post::where('is_approved',false)->get();
        return view('admin-panel.pending-post',compact('posts'));
    }
    public function approved(Request $request, $id){
        $post=Post::find($id);
        $post->is_approved= $request->approved;
        /*$post->is_approved= 1;*/
        $post->update();
        return back()->with('msg', 'Post Has Been Approved');
    }
}
