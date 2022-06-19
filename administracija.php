<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleadmin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <title>Seminar</title>
        <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
        <link rel="stylesheet" href="font/stylesheet.css">
        <?php
session_start();
include 'connect.php';
// Putanja do direktorija sa slikama
define('UPLPATH', 'img/');
// Provjera da li je korisnik došao s login forme
if (isset($_POST['prijava'])) {
 // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
 $prijavaImeKorisnika = $_POST['username'];
 $prijavaLozinkaKorisnika = $_POST['lozinka'];
 $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
 WHERE korisnicko_ime = ?";
 $stmt = mysqli_stmt_init($dbc);
 if (mysqli_stmt_prepare($stmt, $sql)) {
 mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_store_result($stmt);
 }
 mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, 
$levelKorisnika);
 mysqli_stmt_fetch($stmt);
 //Provjera lozinke
 if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && 
mysqli_stmt_num_rows($stmt) > 0) {
 $uspjesnaPrijava = true;
 // Provjera da li je admin
 if($levelKorisnika == 1) {
    $admin = true;
    }
    else {
    $admin = false;
    }
    //postavljanje session varijabli
    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
    } else {
    $uspjesnaPrijava = false;
    }
    
   }
   // Brisanje i promijena arhiviranosti
   ?>
   

    </head>
    <body>
        <header>
            

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Le Monde</h1>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <nav>
                            <ul>
                                <li><a href="index.php" class="anchor">HOME</a></li>
                                <li><a href="kultura.php" class="anchor">KULTURA</a></li>
                                <li><a href="sport.php" class="anchor">SPORT</a></li>
                                <li><a href="#" class="anchor">ADMINISTRACIJA </a></li>
                                <li><a href="unos.html"> UNOS</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="wrap">
            <?php

$dbc = mysqli_connect("localhost", "root", "", "projekt");
mysqli_set_charset($dbc, "utf8");
if ($dbc) {
    #echo "Connected successfully";
    }

$query = "SELECT * FROM vijesti";
$result = mysqli_query($dbc, $query);


$sql = "SELECT * FROM vijesti";
$result = $dbc->query($sql);

while($row = $result->fetch_assoc()){
$selected = $row['kategorija']; ?>
<div class="col-lg-12">
<form enctype="multipart/form-data" action="" method="POST">
 <div class="form-item"> 
 <label for="title">Naslov vijesti:</label>
<div class="form-field"> 
<input type="text" name="title" class="form-field-textual" value="<?php echo $row['naslov'];?>"> 
</div> 
</div> 
<div class="form-item"> 
<label for="about">Kratki sadržaj vijesti:</label> 
<div class="form-field"> 
<textarea name="about" id="" cols="30" rows="10" class="form-field-textual">
    <?php echo $row['sazetak'];?>
</textarea> 
</div> 
</div> 
<div class="form-item"> 
<label for="content">Sadržaj vijesti:</label> 
<div class="form-field"> 
<textarea name="content" id="" cols="30" rows="10" class="form-field-textual">
    <?php echo $row['tekst'];?>
</textarea> 
</div> 
</div> 
<div class="form-item"> 
<label for="pphoto">Slika:</label> 
<div class="form-field">
<input hidden type="text" name="filename" value="<?php echo $row['slika'];?>" id="">
<input type="file" class="input-text" id="pphoto" value="<?php echo $row['slika'];?>" name="pphoto"/> 
<br>
<?php echo '<img src="' . "img/" . $row['slika'] . '" width=100px>'?>
</div> 
</div> 
<div class="form-item"> 
<label for="category">Kategorija vijesti:</label> 
<div class="form-field"> 
<select name="category" id="category" class="form-field-textual" value="<?php echo $row ['kategorija']; ?>">
<option <?php if(strtolower($selected) == "sport"){echo "selected ";} ; echo 'value="Sport"'; ?>>Sport</option>
<option <?php if(strtolower($selected) == "kultura"){echo "selected ";} ; echo 'value="Kultura"'; ?>>Kultura</option>  
</select> 
</div> 
</div> 
<div class="form-item"> 
<label>Spremiti u arhivu: 
<div class="form-field">
<?php 
if($row['arhiva'] == 0) { 
echo '<input type="checkbox" name="archive" id="archive"/> Arhiviraj?'; 
} else { 
    echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?'; 
} 
?>
</div> 
</label> 
</div> 
<div class="form-item"> 
<input type="hidden" name="id" class="form-field-textual" value="<?php echo $row['id'];?>"> 
<button type="reset" value="Poništi">Poništi</button>
<button type="submit" name="update" value="Prihvati"> Izmjeni</button> 
<button type="submit" name="delete" value="Izbriši"> Izbriši</button>
<?php
if(isset($_POST['delete'])){

$id=$_POST['id'];
echo $id;
$sql = "DELETE FROM vijesti WHERE id= '$id' "; 
$result = $dbc->query($sql);
echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST['update'])){
    $picture = $_FILES['pphoto']['name'];
    if($picture == ""){
        $picture = $_POST['slika'];
    }
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    if(isset($_POST['archive'])){
    $archive = 1;
    header("Refresh:1");
    }else{
    $archive = 0;
    }
    $target_dir = 'img/'.$picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    $id=$_POST['id'];
    $sql = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive', slika='$picture' WHERE id=$id ";
    $result = $dbc->query($sql);
    echo "<meta http-equiv='refresh' content='0'>"; 
    }
?> 
</div> </div>
</form>
<br>
<?php
}
?>
            </div>
        </main>

        <footer>
            <div class="container">
                <div class="row">
                    <div class=col-12>
                        <p>Hrvoje Čaldarević</p>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>