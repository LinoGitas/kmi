<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMI - Skaičiuoklė</title>
    <style>
        *:focus {
            outline: none;
        }
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin:0;
            background: rgb(169,219,128);
        }
        h1 { 
            display: block;
            font-size: 2em;
            font-weight: 300;
            width:210px;
            margin:0 auto;
            margin-top: 40px;
            margin-bottom: 40px;
            color:#111; 
        }
        .container {
            background-color: #fff;
            max-width:330px;
            margin:0 auto;
            padding: 60px 40px 40px 40px;
            text-align: center;
            border-radius: 12px; 
            color:#111;
            font-size:16px;
            -webkit-box-shadow: 0px 0px 27px -5px rgba(0,0,0,0.39);
            -moz-box-shadow: 0px 0px 27px -5px rgba(0,0,0,0.39);
            box-shadow: 0px 0px 27px -5px rgba(0,0,0,0.39); 
        }
        .text {
            color:#999;
            font-size:12px;
        }
        label {
            display: inline-block;
            margin:12px 0 6px 0;
            width:285px;
            text-align: left;
        }  
        input[type=text] {
            border: 2px solid #ddd;
            border-radius: 5px;  
            width:250px;
            padding:16px;
            color:#333;
            font-size:15px;
        }
        input[type=submit] {
            background-color: #008CBA;
            border: none;
            color: white;
            border-radius: 5px; 
            padding: 16px 22px;
            text-decoration: none;
            margin-top: 30px;
            cursor: pointer; 
            font-size:15px;
        }
        input[type=submit]:active {
            padding: 17px 23px;
            margin-bottom: -2px;
        }
        .result, .error {
            width:200px;
            margin:0 auto;
            margin-top: 40px;
            text-align: center;
            color:#fff;
            border-radius: 12px; 
            padding:30px;
        }
        .result-bg {
            background-color: #ff9900;
        }
        .error-bg {
            background-color: red;
        }
    </style>
</head>
<body>

<?php
$ugis = FALSE;
$svoris = FALSE;

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if (isset($_POST['ugis']) && !empty($_POST['svoris'])) {
        $ugis = $_POST['ugis'];
        $svoris = $_POST['svoris'];
    }
}
?>

<h1>KMI Skaičiuoklė</h1>

<div class="container">
    <form action="/kmi2/index.php" method="post"> 
        <label for="ugis">Ūgis: <span class="text">(nuo 1.50 iki 1.99)</span></label><br>
        <input type="text" name="ugis" placeholder="0.00" value="<?php echo $ugis;?>" autocomplete="off"><br>
        <label for="svoris">Svoris: <span class="text">(nuo 40 iki 99)</span></label><br>
        <input type="text" name="svoris" value="<?php echo $svoris;?>" autocomplete="off"><br>
        <input type="submit" value="Skaičiuoti">
    </form>
</div>

<?php

if ( !empty($ugis) AND !empty($svoris)) {  
    validation($svoris, $ugis);
    logic($svoris, $ugis);
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    echo  '<div class="error error-bg">Užpildykite laukelius !</div>';
    }
}
?>
</body>
</html>
<?php

function logic($svoris, $ugis) {
    
    $ugis = floatval($ugis);
    $svoris = intval($svoris);
    
    $kmi = round($svoris/($ugis*$ugis), 2);

    echo '<div class="result result-bg">';

        if ($kmi < 18.5) {
            echo 'Nepakankamas svoris !';
        } 
        elseif($kmi > 18.5 && $kmi < 25 ){ 
            echo 'Normalus svoris';
        } 
        elseif($kmi >= 25 && $kmi < 30 ){ 
            echo 'Antsvoris !';
        } 
        elseif ($kmi >= 30) {
            echo 'Nutukimas !';
        } 

    echo '</div>';
}

function validation($svoris, $ugis) {

    if ( !decimal_check($ugis) OR $ugis > 1.99 OR $ugis < 1.50) {
        echo '<div class="error error-bg">Įveskite teisingai ūgį !</div>';
        exit;
    }  

    if ( !exact_length_check($svoris, '2') OR !is_natural_check($svoris) OR $svoris > 99 OR $svoris < 40) {
        echo '<div class="error error-bg">Įveskite teisingai svorį !</div>';
        exit;
    }
}

function decimal_check($str)
{
	return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
}

function exact_length_check($str, $val)
{
	if ( ! is_numeric($val))
	{
		return FALSE;
	}

	return (mb_strlen($str) === (int) $val);
}

function is_natural_check($str)
{
	return ctype_digit((string) $str);
}
?>