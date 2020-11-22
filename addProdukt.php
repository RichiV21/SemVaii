<?php
    require_once("DB/database.php");
    $errors = array("nazov"=>"","cena"=>"","imgURL"=>"","popis"=>"");
    if(isset($_POST["edit"]))
    {
        if(isset($_POST['nazov']) && isset($_POST['cena']) && isset($_POST['imgURL']) && isset($_POST['popis'])) 
        {  
            $error1 = false;
            $error2 = false;
            $error3 = false;
            $error4 = false;
            if(!kontrolaSTR($_POST['nazov'])) {$error1 = true; $errors["nazov"]="nazov je zly";} else {$errors["nazov"]="";}           
            if(!kontrolaINT($_POST['cena'])) {$error2 = true; $errors["cena"]="cena je zla";} else {$errors["cena"]="";}
            if(!kontrolaSTR($_POST['popis'])) {$error3 = true; $errors["popis"]="popis je zly";} else {$errors["popis"]="";}
            if(!kontrolaURL($_POST['imgURL'])) {$error4 = true; $errors["imgURL"]="URL je zle";} else {$errors["imgURL"]="";}
            if(!$error1 && !$error2 && !$error3 && !$error4) 
            {
                $body = array("nazov"=>$_POST['nazov'],"cena"=>$_POST['cena'],"imgURL"=>$_POST['imgURL'],"popis"=>$_POST['popis'],"id"=>$_POST['id']);
                $conn = DBconnect();
                $response = editProdukt($body, $conn);
                DBdestroy($conn);
                header("Location: http://localhost/Semestralka/sem/");
            }          
        }
    }
    else 
    {
        if(isset($_POST['nazov']) && isset($_POST['cena']) && isset($_POST['imgURL']) && isset($_POST['popis'])) 
        {  
            $error1 = false;
            $error2 = false;
            $error3 = false;
            $error4 = false;
            if(!kontrolaSTR($_POST['nazov'])) {$error1 = true; $errors["nazov"]="nazov je zly";} else {$errors["nazov"]="";}           
            if(!kontrolaINT($_POST['cena'])) {$error2 = true; $errors["cena"]="cena je zla";} else {$errors["cena"]="";}
            if(!kontrolaSTR($_POST['popis'])) {$error3 = true; $errors["popis"]="popis je zly";} else {$errors["popis"]="";}
            if(!kontrolaURL($_POST['imgURL'])) {$error4 = true; $errors["imgURL"]="URL je zle";} else {$errors["imgURL"]="";}
            if(!$error1 && !$error2 && !$error3 && !$error4) 
            {
                $body = array("nazov"=>$_POST['nazov'],"cena"=>$_POST['cena'],"imgURL"=>$_POST['imgURL'],"popis"=>$_POST['popis']);
                $conn = DBconnect();
                $response = addProdukt($body, $conn);
                DBdestroy($conn);
                header("Location: http://localhost/Semestralka/sem/");
            }         
        }
    }

    $edit=false;
    $editData="";
    if(isset($_GET["edit"])) 
    {
        $edit = true;
        $conn = DBconnect();
        $editData = getProdukt($conn, $_GET["edit"]);
        DBdestroy($conn);
        if($editData->num_rows == 0) {header("Location: http://localhost/Semestralka/sem/404.php");}
    }
?>

<?php
    include_once("includes/header.html");
    if($edit) 
    {
        while($produkt = $editData->fetch_assoc()) 
        { 
?>

<form action="http://localhost/Semestralka/sem/addProdukt.php?edit=<?php echo $_GET["edit"]; ?>" method="POST">
<label for="nazov">Názov</label>
<input id="nazov" type="text" name="nazov" value="<?php echo $produkt["nazov"]; ?>">
<?php
    if(strlen($errors["nazov"]) > 0) {echo $errors["nazov"].'<br>';}
?>
<label for="cena">Cena</label>
<input id="cena" type="number" name="cena" value="<?php echo $produkt["cena"]; ?>">
<?php
    if(strlen($errors["cena"]) > 0) {echo $errors["cena"].'<br>';}
?>
<label for="imgURL">URL obrázku</label>
<input id="imgURL" type="text" name="imgURL" value="<?php echo $produkt["imgURL"]; ?>">
<?php
    if(strlen($errors["imgURL"]) > 0) {echo $errors["imgURL"].'<br>';}
?>
<label for="popis">Popis</label>
<textarea id ="popis" name="popis"  rows="1" ><?php echo $produkt["popis"]; ?></textarea>
<?php
    if(strlen($errors["popis"]) > 0) {echo $errors["popis"].'<br>';}
?>
<input type="hidden" value="true" name="edit">
<input type="hidden" value="<?php echo $_GET["edit"]; ?>" name="id">
<button type="submit">Odoslať</button>
</form>

<?php
        }
    } 
    else 
    {
?>

<form action="http://localhost/Semestralka/sem/addProdukt.php" method="POST">
<label for="nazov">Názov</label>
<input type="text" name="nazov" placeholder="nazov">
<?php
    if(strlen($errors["nazov"]) > 0) {echo $errors["nazov"];}
?>
<label for="cena">Cena</label>
<input type="number" name="cena" placeholder="cena">
<?php
    if(strlen($errors["cena"]) > 0) {echo $errors["cena"];}
?>
<label for="imgURL">URL obrázku</label>
<input type="text" name="imgURL" placeholder="imageURL">
<?php
    if(strlen($errors["imgURL"]) > 0) {echo $errors["imgURL"];}
?>
<label for="popis">Popis</label>
<textarea name="popis" placeholder="popis" rows="1"></textarea>
<?php
    if(strlen($errors["popis"]) > 0) {echo $errors["popis"];}
?>
<button type="submit">Odoslať</button>
</form>

<?php
    } 
    include_once("includes/footer.html");
?>