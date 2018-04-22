<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="_token" content="{!! csrf_token() !!}" />

    <!-- Site Properties -->
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

</head>

<body class="admin-login-body">

    <div class="ui centered raised card">
      <div class="content">
        <img class="right floated mini ui image" src="{{asset('img/logo_web_admin.png')}}">
        <div class="header centered">Pemetaan SMK Surabaya</div>
        <div class="meta">Administrator</div>
        <div class="description">
          <form class="ui form loginAdmin" enctype="multipart/form-data">
            <div class="field">
              <input id="username" type="text" name="username" placeholder="Username">
            </div>
            <div class="field">
              <input id="password" type="password" name="password" placeholder="Password">
            </div>
            <button class="fluid ui brown button login">Login</button>
          </form>
        </div>
      </div>
    </div>

    <script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
