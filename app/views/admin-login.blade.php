<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <title>Administrator Login</title>

    @include('admin.includes.common_css')
    {{HTML::style(asset("/public/css/site/admin-login.css"))}}

    @include('admin.includes.common_js_top')
</head>

<body>

<form id="frm">
    Username: <input type="text" name="username"/> <br/><br/>
    Password: <input type="password" name="password"/> <br/><br/>

    <input type="button" id="btnlogin" value="Login"/> <br/><br/>

    <span id="message"></span>
</form>

@include('admin.includes.common_js_bottom')
{{HTML::script(asset("/public/js/site/admin-login.js"))}}

</body>
</html>
