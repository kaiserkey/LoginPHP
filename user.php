<?
require_once('config.php');
session_start();
if(!empty($_SESSION)){
    
}else{
    header("Location: " . constant('URL') . "login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User <? if(!empty($_SESSION)) {echo $_SESSION['USER'];} ?></title>
</head>
<body>
    <h1>Usuario Logeado <? if(!empty($_SESSION)) {echo $_SESSION['USER'];} ?></h1>
</body>
</html>

<?
session_unset();
session_destroy();
?>