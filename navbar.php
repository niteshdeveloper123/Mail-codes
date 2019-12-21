<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                            @can('categories')
                                <li><a class="nav-link" href="{{ route('manage.terms') }}">Categories</a></li>
                            @endcan
                            @can('tags')
                                <li><a class="nav-link" href="{{ route('manage.tags') }}">Tags</a></li>
                            @endcan
                            @can('manage-user')
                                <li><a class="nav-link" href="{{ route('manage.user') }}">Manage Users</a></li>
                            @endcan
                            @can('roles')
                                <li><a class="nav-link" href="{{ route('manage.roles') }}">Manage Role</a></li>
                            @endcan
                            @can('permissions')
                                <li><a class="nav-link" href="{{ route('manage.permissions') }}">Manage Permissions</a></li>
                            @endcan
                                <li><a class="nav-link" href="{{ route('manage.courses') }}">All Courses</a>
                                </li>
                                <li><a class="nav-link" href="{{ route('manage.students') }}">All Students</a>
                                <li><a class="nav-link" href="{{ route('manage.groups') }}">All Student groups</a></li>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                12:29 02-12-2019
            </div>
        </main>
    </div>
    <script type="text/javascript">
    function assign(permission)
    {
        if (permission.checked == true) {
            var permission_id = permission.value;
            var role_id = document.getElementById('role-id').value;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: "{{ route('permissions-assign') }}",
              cache: false,
              type: 'POST',
              data: {_token: CSRF_TOKEN, permission_id: permission_id, role_id: role_id},
              dataType: 'JSON',
              success: function(data){
                
              }
            });
        }
        else
        {
            var permission_id = permission.value;
            var role_id = document.getElementById('role-id').value;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              url: "{{ route('permission.unassign') }}",
              cache: false,
              type: 'POST',
              data: {_token: CSRF_TOKEN, permission_id: permission_id, role_id: role_id},
              dataType: 'JSON',
              success: function(data){
                
              }
            });
        }
    }
    function assignrole(role_id, user_id)
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
          url: "{{ route('role-assign') }}",
          cache: false,
          type: 'POST',
          data: {_token: CSRF_TOKEN, user_id: user_id, role_id: role_id},
          dataType: 'JSON',
          success: function(data){
            
          }
        });
    }

    function submitForm() {
        return confirm('Do you really want to submit the form?');
    }
    </script>
    @stack('scripts')
</body>