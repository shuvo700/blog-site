@extends('admin-panel.admin-layout')
@push('style')
<!-- Bootstrap Select Css -->
<link href="{{asset('admin-panel/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .select2-selection{
        border-bottom: 1px solid #ddd;
    }
</style>
<link rel="stylesheet" href="admin-panel/plugins/ckeditor/css/samples.css">
<link rel="stylesheet" href="admin-panel/plugins/ckeditor/toolbarconfigurator/lib/codemirror/neo.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-6 block-header">
                    <h2 class="">CREATE NEW POST</h2>
                </div>
               
            </div>
            @if ($errors->any())
                <div class="alert bg-red alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ implode('', $errors->all(':message')) }}
                </div>
             @endif
             @if(Session::has('msg'))
            <div class="alert bg-green alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{Session::get("msg")}}
            </div>
             @endif              
        </div>
    </div>
    <!-- Exportable Table -->
    <form action="{{url('admin/post/store')}}" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add New Post</h2>
                        </div>
                        <div class="body">
                             
                                <!-- <label for="title">Post Title</label> -->
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter your Post Title" value="{{old('title')}}">
                                    </div>
                                </div>
                                <label for="post_image">Post image</label>
                                <div class="form-group">
                                    <input type="file" id="post_image" name="image" class="form-control">
                                </div>
                                <input type="checkbox" id="status" name="status" class="filled-in" value="1">
                                <label for="status">Is Published</label>         
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Categories & Tags</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">                               
                                <label for="post_categories">Select Categories</label>
                                
                                <select name="categories[]" id="post_categories" class="form-control show-tick" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>                             
                            </div>
                            <div class="form-group">
                                
                                    <label for="post_tags">Select Tags</label>
                                <select name="tags[]" id="post_tags" class="form-control show-tick" data-live-searh="true" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                             <div class="btn-inline">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                                <button type="submit" class="btn btn-success m-t-15 waves-effect">Back</button>
                             </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
               <div class="row">
                   <div class="card">
                       <div class="header">
                           <h2>Post Body</h2>
                       </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" id="editor" class="form-control no-resize" name="body" placeholder="Please type what you want..."></textarea>

                                </div>
                            </div>
                             <div class=" text-right">
                                <div class="btn-inline">
                                    <button type="submit" class="btn btn-success btn-lg waves-effect">Save</button>
                                   
                                 </div>
                           </div>

                       </div>

                   </div>
                  
               </div>            
                                
            </div>
        </form>
            <!-- #END# Exportable Table -->
</div>
@endsection
@push('script')
<!-- TinyMCE -->
    <script src="{{asset('admin-panel/plugins/tinymce/tinymce.js')}}"></script>



    <script src="{{asset('admin-panel/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(".multiple_data_select").select2({
  theme: "classic",
  width: 'resolve',

});
</script>
<script src="{{asset('admin-panel/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin-panel/plugins/ckeditor/js/sample.js')}}"></script>
<script>
    initSample();
</script>

@endpush