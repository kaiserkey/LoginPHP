<?
    require_once('config.php');
    require_once('conection.php');
    if(isset($_POST['user']) && isset($_POST['password'])){
        $con = new Conection();
        $conexion = $con->getConection();
        $user= $_POST['user'];
        $password =  password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost'=>10]);
        
        try{
            $query = $conexion->prepare("INSERT INTO user (nombre, password) VALUES (:nom, :pass)");
            
            $query->execute([
                ':nom'=>$user,
                ':pass'=>$password
            ]);
            $result = "Se guardo el usuario correctamente.";
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
        <form action="<?php echo constant('URL') . 'signup.php'; ?>" method="post">
            <table>
                <tr>
                    <th colspan="2">Registro de Usuario</th>
                </tr>
                <tr>
                    <td><label for="user">Nombre</label></td>
                    <td><input type="text" name="user" id="user"></td>
                </tr>
                <tr>
                    <td><label for="password">Contraseña</label></td>
                    <td><input type="number" name="password" id="password"></td>
                </tr>
                <tr>
                    <th colspan="2"><input type="submit" value="Registrar"></th>
                </tr>
                <tr>
                    <th colspan="2"><a href="<?php echo constant('URL') . 'login.php';?>"><input type="button" value="Login"></a></th>
                </tr>
                <tr>
                    <th colspan="2"><? if(!empty($result)) {echo $result;} ?></th>
                </tr>
            </table>
        </form>

    </section>
</body>
</html>