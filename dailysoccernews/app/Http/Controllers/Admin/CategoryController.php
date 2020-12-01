<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data=Category::latest()->get();
        return view('admin-panel.category',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
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
            'name' => 'required|min:2|unique:categories,slug,.($id)', 
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            //'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);                
            $data= new Category();
            $data->name= $request['name'];
            $data->slug= str_slug($request->name);
             //image
        /*if($request->image !=''){
                $destinationPath =   public_path('/images/category');
                $file = $request->image;
                $ext = $request->image->getClientOriginalExtension();
                $fileName =str_slug($request->name).'.'.$ext;
                if(file_exists($destinationPath.'/'.$fileName)){
                    @unlink($destinationPath.'/'.$fileName);
                }
                $file->move($destinationPath, $fileName);
                $data->image = $fileName;
            }*/
            if($request->image !=''){
            // delete previous image
            $destinationPath =   public_path('/images/category');
            $file = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $fileName =str_slug($request->name).'.'.$ext;
            if(file_exists($destinationPath.'/'.$fileName)){
                @unlink($destinationPath.'/'.$fileName);
            }
            $file->move($destinationPath, $fileName);
            $data->image = $fileName;
        }


            // image end
            $data->save(); 
            session()->flash('msg', 'Successfully update Category');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $this->validate(request(),[
            'name' => 'required|min:2|unique:categories,slug,'.$id,
            ]); 
        $data = Category::find($id);
        $data->name = $request->name;
        $data->slug= str_slug($request->name);
          //image
        if($request->image !=''){
                $destinationPath =   public_path('/images/category');
                $file = $request->image;
                $ext = $request->image->getClientOriginalExtension();
                $fileName =$data->slug.'.'.$ext;
                if(file_exists($destinationPath.'/'.$fileName)){
                    @unlink($destinationPath.'/'.$fileName);
                }
                $file->move($destinationPath, $fileName);
                $data->image = $fileName;
            }
            // image end
        $data->update(); 
        session()->flash('msg', 'Successfully Update Category');
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
        //
        $category= Category::find($id);
        // delete image
        $destinationPath =   public_path('/images/category');
        $fileName =  $category->image;
        if(file_exists($destinationPath.'/'.$fileName)){
            @unlink($destinationPath.'/'.$fileName);
        }
        $category->posts()->detach(); // delete with many to many relationship
        $category->delete();
        return back()->with('msg', 'Category Has Been Deleted');
    }
}
