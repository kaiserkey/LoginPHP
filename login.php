<?
require_once('config.php');
require_once('conection.php');

if(isset($_POST['user']) && isset($_POST['password'])){
    $con = new Conection();
    $conexion = $con->getConection();
    $user= htmlentities(addslashes($_POST['user']));
    $password = htmlentities(addslashes($_POST['password']));

    try{
        $query = $conexion->prepare("SELECT * FROM user WHERE nombre=:nom");

        $query->execute([':nom'=>$user]);
        if($query->rowCount() == 1){
            $datos = $query->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $datos['password'])){
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                    $_SESSION['USER'] = $datos['nombre'];
                    header("Location: " . constant('URL') . "user.php");
                }
            }else{
                echo "La contraseña es incorrecta.";
            }
        }else{
            echo "Datos incorrectos, no se puede logear.";
        }
    }catch(PDOException $e){
        echo $e;
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
</head>
<body>
    <section>
        <form action="<?php echo constant('URL') . 'login.php'; ?>" method="post">
            <table>
                <tr>
                    <th colspan="2">Login</th>
                </tr>
                <tr>
                    <td><label for="user">Nombre</label></td>
                    <td><input type="text" name="user" id="user"></td>
                </tr>
                <tr>
                    <td><label for="password">Contraseña</label></td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <th colspan="2"><input type="submit" value="Entrar"></th>
                </tr>
                <tr>
                    <th colspan="2"><a href="<?php echo constant('URL') . 'signup.php';?>"><input type="button" value="Signup"></a></th>
                </tr>
                <tr>
                    <th colspan="2"><? if(!empty($result)) {echo $result;} ?></th>
                </tr>
            </table>
        </form>

    </section>
</body>
</html>