<?
require_once('config.php');
class Conection{
    private $conection;

    public function __construct()
    {
        $this->setConection($this->conectionDB());
    }

    public function conectionDB(){
        try{
            $con = new PDO(DATABASE . 'host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->exec('SET CHARACTER SET '.CHARSET);
            return $con;
        }catch(PDOException $e){
            return "ERROR: No se ha posido establecer la copnexion a la base de datos: ".$e;
        }
    }

    public function getConection(){return $this->conection;}
    public function setConection($conection){$this->conection = $conection;return $this;}

}
?>
