<h1>KMI Skaičiuoklė</h1>

<div class="container">
    <form action="http://localhost:8888/kmi/" method="post"> 
        <label for="ugis">Ūgis: <span class="text">(nuo 1.50 iki 1.99)</span></label><br>
        <input type="text" name="ugis" placeholder="0.00" value="<?php echo $ugis;?>" autocomplete="off"><br>
        <label for="svoris">Svoris: <span class="text">(nuo 40 iki 99)</span></label><br>
        <input type="text" name="svoris" value="<?php echo $svoris;?>" autocomplete="off"><br>
        <input type="submit" value="Skaičiuoti">
    </form>
</div>