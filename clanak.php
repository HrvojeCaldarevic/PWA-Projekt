<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <title>Clanci</title>
        <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
        <link rel="stylesheet" href="font/stylesheet.css">
    </head>
    <body>
        <header>
        <?php
        include 'connect.php';
        define('URLPATH', 'images/');
        $id = $_GET['id'];
        $query = "SELECT * FROM vijesti WHERE id='$id'" ;
        $result = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result))
        {
        $category = $row['kategorija'];
        $title = $row['naslov'];
        $image = $row['slika'];
        $about = $row['sazetak'];
        $content = $row['tekst'];
        }
        ?>

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
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="kultura.php" class="anchor">KULTURA</a></li>
                                <li><a href="sport.php" class="anchor">SPORT</a></li>
                                <li><a href="administracija.php" class="anchor">ADMINISTRACIJA</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <main>
        <div class="wrap" style="padding:0 10px">
            <section role="main">
                <div class="naslov">
                <h3 style="text-transform:uppercase;padding:5px;"><?php
                echo $category;
                ?></h3><br/>
                <h1 class="title"><?php
                echo $title;
                ?></h1><br/>
                </div>
                <section class="slika">
                <?php
                echo "<img src='img/$image' style='display:block;margin:0 auto'";
                ?>
                </section>
                <section class="about">
                <p style="color:gray; font-weight: bold;">
                <?php
                echo $about;
                ?>
                </p>
                </section>
                <section class="sadrzaj">
                <p>
                <?php
               echo $content;
                ?>
                </p>
                </section>
                </section>
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
