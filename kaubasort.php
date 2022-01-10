<?php
// kasutatakse abifuntoonid
require("abifunktionid.php");
$kaubad=kysiKaupadeAndmed();

if(isSet($_REQUEST["sort"])){
    $kaubad=kysiKaupadeAndmed($_REQUEST["sort"]);
} else {
    $kaubad=kysiKaupadeAndmed();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <div class="header">
    <h1>Kaubaotsing</h1>
    </div>
    <title>Kaupade leht</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<table>

    <tr>
        <th><a href="kaubasort.php?sort=nimetus">Nimetus</a></th>
        <th><a href="kaubasort.php?sort=grupinimi">Kaubagrupp</a></th>
        <th><a href="kaubasort.php?sort=hind">Hind</a></th>
    </tr>


    <!--tagastab massivsit andmed-->
    <?php foreach($kaubad as $kaup): ?>
        <tr>
            <td><?=$kaup->nimetus ?></td>
            <td><?=$kaup->grupinimi ?></td>
            <td><?=$kaup->hind ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>



