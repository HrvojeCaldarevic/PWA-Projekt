<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <title>Seminar</title>
        <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
        <link rel="stylesheet" href="font/stylesheet.css">
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
                                <li><a href="#home" class="anchor">HOME</a></li>
                                <li><a href="kultura.php" class="anchor">KULTURA</a></li>
                                <li><a href="sport.php" class="anchor">SPORT</a></li>
                                <li><a href="login.html" class="anchor">ADMINISTRACIJA</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="wrap">
            <section class="ikone">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <a name="politika"></a>
                            <h3><strong>Kultura</strong></h3>
                        </div>
                        <div class="col-lg-10"></div>                                  
                    </div>
                </div>
            </section>
                <div class="container slike-vrh">
                    <div class="row">
                    <div class="col-lg-12">

<?php
include 'connect.php';
define('UPLPATH', 'img/');
$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' LIMIT 4";
$result = mysqli_query($dbc, $query);
 $i=0;
 while($row = mysqli_fetch_array($result)) {
 echo '<article style="width:400px; margin:0 auto;">';
 echo'<div class="article">';
 echo '<div class="sport_img">';
 echo '<img src="' . UPLPATH . $row['slika'] . '"; style="width:400px;"';
 echo '</div>';
 echo '<div class="media_body">';
 echo '<h4 class="title">';
 echo '<a href="clanak.php?id='.$row['id'].'">';
 echo $row['naslov'];
 echo '</a></h4>';
 echo '<p style=word-break: break-word;>';
 echo $row['sazetak'];
 echo '</p>';
 echo '</div></div>';
 echo '</article>';
}?> 
</div>

            </div>
        </div>
                <hr id="bodyhr"/>
                <section class="ikone">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">
                                <a name="sport"></a>
                                <h3><strong>Sport</strong></h3>
                            </div>
                            <div class="col-lg-10"></div>                                  
                        </div>
                    </div>
                </section>

                <div class="container slike-vrh">
                    <div class="row">
                    <div class="col-lg-12">

                        <?php
$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' LIMIT 4";
$result = mysqli_query($dbc, $query);
 $i=0;
 while($row = mysqli_fetch_array($result)) {
    echo '<article style="width:400px; margin:0 auto;">';
    echo'<div class="article">';
    echo '<div class="sport_img">';
    echo '<img src="' . UPLPATH . $row['slika'] . '"; style="width:400px;"';
    echo '</div>';
    echo '<div class="media_body">';
    echo '<h4 class="title">';
    echo '<a href="clanak.php?id='.$row['id'].'">';
    echo $row['naslov'];
    echo '</a></h4>';
    echo '<p style=word-break: break-word;>';
    echo $row['sazetak'];
    echo '</p>';
    echo '</div></div>';
    echo '</article>';
}?> 
</div>
</div>
        </div>
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