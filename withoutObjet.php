<?php
$floors = 6;
$lignes = 3;
$height = 3;
$width = 3;
$nbStars = 1;
$nbMax = $floors * 4 + 3;
$garland = false;
$balls = true;
$tableau = array(); 

function createLine($nbMax, $nbStars, $garland){
    $resultat = "";
    $spaces = $nbMax - $nbStars;
    if($garland){
        return $resultat = str_repeat("&nbsp",intdiv($spaces, 2)) . "S" . str_repeat("*",$nbStars) . "S" . str_repeat("&nbsp",intdiv($spaces, 2)) . "<br/>";
    }
    $resultat = str_repeat("&nbsp",intdiv($spaces, 2)) . str_repeat("*",$nbStars) . str_repeat("&nbsp",intdiv($spaces, 2)) . "<br/>";
    return $resultat;
}

function createFoot($nbMax, $height, $width, $floors, $etoiles, $balls){
    $path = array("|", "0", "&nbsp", "&nbsp");
    $spaces = $nbMax - $width;
    $etoiles = $etoiles - $width;
    $etoiles = intdiv($etoiles, 4);
    if($balls){
        return $resultat = "&nbsp" . str_repeat($path[$floors] . "&nbsp", $etoiles) . str_repeat("*", $width) . str_repeat("&nbsp" . $path[$floors], $etoiles) . "&nbsp<br/>";
    } else {
        return $resultat = str_repeat("&nbsp", intdiv($spaces, 2)) . str_repeat("*", $width) . str_repeat("&nbsp", intdiv($spaces, 2)) . "<br/>";
    }
}

for($n=1; $n <= $floors; $n++){
    for($i=1; $i <= $lignes; $i++){ 
        if($i == $lignes){
            $garland = !$garland;
        }
        array_push($tableau, createLine($nbMax, $nbStars, $garland));
        if ($nbStars == 1){
            $nbStars += 2;
        } else {
            $nbStars += 4;
        }
    }
    $nbStars -= 8;
    $garland = !$garland;
}

$etoiles = substr_count($tableau[count($tableau) - 1], '*');

for($p=0; $p <= $height; $p++){ 
    array_push($tableau, createFoot($nbMax, $height, $width, $p, $etoiles, $balls));
}
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <pre>
        <?php
            foreach($tableau as $ligne){ 
                echo($ligne);
            }
        ?>
    </pre>    
</body>