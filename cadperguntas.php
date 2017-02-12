<?php
include_once "conectaDatabase.php";


/*$perg = $_POST["perg"];
$a = $_POST["a"];
$b = $_POST["b"];
$c = $_POST["c"];
$d = $_POST["d"];
$e = $_POST["e"];
$respcerta = $_POST["respcerta"]*/

$perg = "Quando o volume lógico corrompe em uma LVM, mantida no sda1 e com o nome logical-volume, qual o primeiro comando a ser executado em uma sessão live?";
$a = "fsck /dev/mapper/logical-volume";
$b = "fsck /dev/sda1";
$c = "vgchange -a y";
$d = "mount /dev/mapper/logical-volume";
$e = "mount /dev/sda1";
$respcerta = 'c';

$arrayParametros = array($perg, $a, $b, $c, $d, $e, $respcerta);

$sql = "INSERT INTO perguntas(perg, a, b, c, d, e, respcerta)
	    VALUES(?,?,?,?,?,?,?)";
		
//$conn = $db->getDB();
		
//if($db->executeDML($sql, $arrayParametros, $conn))
	//header("Location: perguntas.php");
	//echo "Pergunta Cadastrada!";
//}

$i = 1;
$sql2 = "SELECT perg, a, b, c, d, e FROM perguntas WHERE id = " .$i;
$dados = $db->executeQuery($sql2, $i, $conn);
while($linha = $dados->fetch(PDO::FETCH_ASSOC))
{
    echo "{$linha['perg']} <br> a){$linha['a']} <br>  b){$linha['b']} <br> c){$linha['d']}  <br> d){$linha['d']} <br> e){$linha['e']}";
}

?>