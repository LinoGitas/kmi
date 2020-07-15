<?php
$ugis = FALSE;
$svoris = FALSE;

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if (isset($_POST['ugis']) && isset($_POST['svoris'])) {
        $ugis = $_POST['ugis'];
        $svoris = $_POST['svoris'];
    }
}

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

include_once('form1.php');

if ( !empty($ugis) AND !empty($svoris)) {  
    validation($svoris, $ugis);
    logic($svoris, $ugis);
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    echo  '<div class="error error-bg">Užpildykite laukelius !</div>';
    } else {
        $ugis = FALSE;
        $svoris = FALSE;
        include_once('form1.php');
    }
}
?>