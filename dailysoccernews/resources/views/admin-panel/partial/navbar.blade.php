<div class="menu">
                <ul class="list">
                    
                    @if (Request::is('admin/*'))
                    
                    <li class="header">Admin Dashboard</li>
                    <li class="{{Request::is('admin/dashboard')?'active':''}}">
                        <a href="{{url('admin/dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="{{Request::is('admin/tag')?'active':''}}">
                        <a href="{{url('admin/tag')}}">
                            <i class="material-icons">attachment</i>
                            <span>Tags</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/category')?'active':''}}">
                        <a href="{{url('admin/category')}}">
                            <i class="material-icons">linear_scale</i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/post*')?'active':''}}">
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="material-icons">layers</i>
                            <span>Post</span>
                        </a>
                        <ul class="ml-menu">
                            
                            <li class="{{Request::is('admin/post/create')?'active':''}}">
                                <a href="{{url('admin/post/create')}}" class="waves-effect waves-block">
                                  <span>Create New Post</span>
                                </a>
                            </li>
                            <li class="{{Request::is('admin/post')?'active':''}}">
                                <a href="{{url('admin/post')}}" class=" waves-effect waves-block">
                                    <span>All Post</span>
                                </a>
                            </li>
                            <li class="{{Request::is('admin/post/pending*')?'active':''}}">
                                <a href="{{url('admin/post/pending')}}" class=" waves-effect waves-block">
                                    <span>Pending Post</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                <li class="{{Request::is('admin/user*')?'active':''}}">
                    <a href="{{url('admin/user')}}">
                        <i class="material-icons">people_outline</i>
                        <span>User</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/subscriber')?'active':''}}">
                    <a href="{{url('admin/subscriber')}}">
                        <i class="material-icons">people</i>
                        <span>Subscribers</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/favorite*')?'active':''}}">
                    <a href="{{url('admin/favorite')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>
                 <li class="{{Request::is('admin/comment*')?'active':''}}">
                    <a href="{{url('admin/comment')}}">
                        <i class="material-icons">comment</i>
                        <span>Comment List</span>
                    </a>
                </li>
                {{-- author navbar--}}
                @elseif(Request::is('author/*'))
                    <li class="header">Author Dashboard</li>
                    <li class="{{Request::is('author/dashboard')?'active':''}}">
                        <a href="{{url('author/dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/post*')?'active':''}}">
                        <a href="{{url('author/post')}}">
                            <i class="material-icons">book</i>
                            <span>Post</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/profile*')?'active':''}}">
                        <a href="{{url('author/profile')}}">
                            <i class="material-icons">mood</i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/fevorite*')?'active':''}}">
                        <a href="{{url('author/fevorite')}}">
                            <i class="material-icons">favorite</i>
                            <span>Favorite List</span>
                        </a>
                    </li>

                @else
                <p class="text-danger">Nothing To Show</p>   
                @endif
                </ul>
            </div>