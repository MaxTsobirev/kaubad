
<?php
/*create table Uuekasutajad(
id int primary key AUTO_INCREMENT,
unimi varchar(100),
psw varchar(100),
isadmin int)*/
//lisame oma kasutajanimi,parooli ja ab_nimi
$yhendus=new mysqli("localhost", "kolya17", "123456", "kolya17");
session_start();

$error=$_SESSION["error"];
//
function puhastaAndmed($data){
    // trim eemaldab tühikud
    $data=trim($data);
    $data=htmlspecialchars($data); //Преобразует специальные символы в HTML-сущности
   // Удаляет экранирование символов, произведенное функцией
    $data=stripslashes($data);
    return $data;
}
if(isset($_REQUEST["knimi"])&& isset($_REQUEST["psw"])){



$login=puhastaAndmed($_REQUEST["knimi"]);
$pass=puhastaAndmed($_REQUEST["psw"]);
$sool="vagavagatekst";
$krypt=crypt($pass,$sool);

$kask=$yhendus->prepare("SELECT id,unimi,psw from uuekasutajad WHERE unimi=?");
$kask->bind_param("s",$login);
$kask->bind_result($id,$kasutajanimi,$parool);
$kask->execute();
if($kask->fetch()){
    $_SESSION["error"]="Kasutaja on juba olemas";
    header("location:$_SERVER[PHP_SELF]");
    $yhendus->close();
    exit();
} else{
    $_SESSION["error"]=" ";
}

$kask=$yhendus->prepare("INSERT INTO uuekasutajad(unimi,psw,isadmin)VALUES(?,?,?)");
$kask->bind_param("ssi",$login,$krypt,$_REQUEST["admin"]);
$kask->execute();
$_SESSION["unimi"]=$login;
$_SESSION["admin"]=true;
//header("Location:kaubahaldus.php");
$yhendus->close();



}
?>
<!DOCTYPE html>
<html>
<head>

    <title>Registrationvorm</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"

</head>
<body>
<h1>Uue kasutaja registremine</h1>
<form a ction="login.php"method="post">
    <label for="knimi">Kasutajanimi</label>
    <input type="text" placeholder="Sisesta kasutajanimi"
           name="knimi" id="knimi"required>
    <br>
    <label for="psw">Parool</label>
    <input type="password" placeholder="Sisesta parool"
           name="psw" id="psw"required>
    <br>
    <label for="admin">Kas teha admin?</label>
    <input type="checkbox"
           name="admin" id="admin" value="1">
    <br>
    <input type="submit" value="Loo kasutaja">
    <strong><?=$error?></strong>
</form>

</body>

</html>