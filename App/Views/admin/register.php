<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/public/css/toast.css">
    </head>
<body>
<form method="POST" action="/admin/register">
    <input type="text" name="name"/>
    <input type="text" name="email"/>
    <input type="text" name="password"/>
    <input type="submit" value="Click" />
</form>
<div id="snackbar">
    csdc cksdncksd cknsdkn
</div>  
<?php if (isset($status)): ?>
    <script src="/public/js/toast.js"></script>
<?php endif ?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>