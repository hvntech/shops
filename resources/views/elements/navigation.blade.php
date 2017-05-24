<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"><b>Soccast - Admin Panel</b></a>
        <ul class="nav navbar-nav navbar-right">
            <li><a>Login as {{ admin_user('email') }}</a></li>
            <li><a href="{{ route('logout') }}" id="logout">Logout</a></li>
        </ul>
    </div>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#">Manage Video<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('video_lists') }}">Video List</a>
                        </li>
                        <li>
                            <a href="{{ route('video_create') }}">Create Video</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Manage Event<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('event_lists') }}">Event List</a>
                        </li>
                        <li>
                            <a href="{{ route('event_create') }}">Create Event</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Manage News<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('news_lists') }}">News List</a>
                        </li>
                        <li>
                            <a href="{{ route('news_create') }}">Create News</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Manage User<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('user_index') }}">User List</a>
                        </li>
                        <li>
                            <a href="{{ route('user_create') }}">Create User</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('page_edit', ['type' => \App\Models\PageContent::PAGE_ABOUT]) }}">About</a>
                </li>
                <li>
                    <a href="#">Settings<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="{{ route('page_edit', ['type' => \App\Models\PageContent::PAGE_PRIVACY]) }}">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{ route('page_edit', ['type' => App\Models\PageContent::PAGE_TERMS]) }}">Terms and Conditions</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>