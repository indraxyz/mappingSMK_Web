
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

</head>
<body class="admin">

    <!-- side menu for mobile -->
    <div class="ui sidebar inverted vertical menu">
        <a href="" class="item">Sekolah</a>
        <a href="" class="item">User</a>
        <a href="" class="item">Komentar</a>
        <a href="" class="item">Like Sekolah</a>
    </div>
    <!-- mobile fixed menu -->
    <div class="ui menu borderless fixed mobile-menu">
        <a class="item sidebar-button">
            <i class="content icon"></i>
        </a>
        <a href="{{url('#')}}" class="item">Pemetaan SMK SBY</a>
        <div class="right menu">
            <div class="ui dropdown icon item">
                <i class="ui brown horizontal label topUsername">{{session('loginAdmin.username')}}</i>
                <i class="large configure icon"></i>
                <div class="menu">
                	@if(session('loginAdmin.akses') == 1)
						<a href="{{url('vCrudAdmin')}}" class="ui item"><i class="lock icon"></i> Manage Admin</a>
                	@endif                 
                    <a href="{{url('vMyProfileAdmin')}}" class="ui item"><i class="user icon"></i> My Profile</a>
                    <a href="{{url('logoutAdmin')}}" class="ui item"><i class="sign out icon"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- default menu -->
    <div class="ui menu borderless fixed default-menu">
        <h5 class="ui header item">
          <img src="{{asset('img/logo_web_admin.png')}}" class="ui circular image">
          Pemetaan SMK Surabaya
        </h5>
        <!-- <a href="" class="item">Crime Nesia</a> -->

        <div class="right menu">
            <div class="ui dropdown icon item">
                <i class="large idea icon"></i>
                <div class="menu">
                    <a href="{{url('vManageUser')}}" class="ui item"><i class="user icon"></i> User</a>
                    <a href="{{url('vCrudSekolah')}}" class="ui item"><i class="student icon"></i> Sekolah</a>
                    <a href="{{url('vKomentar')}}" class="ui item"><i class="comments icon"></i> Komentar</a>
                    <a href="{{url('vLikeSekolah')}}" class="ui item"><i class="star icon"></i> Like Sekolah</a>
                </div>
            </div>
                   
            <div class="ui dropdown icon item">
                <i class="ui brown horizontal label topUsername">{{session('loginAdmin.username')}}</i>
                <i class="large configure icon"></i>
                <div class="menu">
                    @if(session('loginAdmin.akses') == 1)
                        <a href="{{url('vCrudAdmin')}}" class="ui item"><i class="lock icon"></i> Manage Admin</a>
                    @endif

                    <a href="{{url('vMyProfileAdmin')}}" class="ui item"><i class="user icon"></i> My Profile</a>
                    <a href="{{url('logoutAdmin')}}" class="ui item"><i class="sign out icon"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div class="pusher">
        <div class="ui container">
            <!-- Isi Page -->
            @yield('page_content')

        </div>  
    </div> <!-- end .pusher -->

<script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
