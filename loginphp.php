<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <title>Projekt</title>
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
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="kultura.php" class="anchor">KULTURA</a></li>
                                <li><a href="sport.php" class="anchor">SPORT</a></li>
                                <li><a href="#" class="anchor">ADMINISTRACIJA</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    <main>
        <section>
        <?php 

        $dbc = mysqli_connect("localhost", "root", "", "projekt");
            mysqli_set_charset($dbc, "utf8");
        if ($dbc) {
            #echo "Connected successfully";
        }

        $username = $_POST['username'];
        $lozinka = $_POST['pass'];
        $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);

        //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
        $query = "SELECT * FROM korisnik WHERE korisnicko_ime='$username'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);

        if (mysqli_num_rows($result)>0) {
            if (password_verify($lozinka, $row['lozinka'])) {
                #echo ('Uspjesan login');
                if ($row['razina'] == 1) {
                    echo '<a href="administracija.php">Kliknite da nastavite</a>';
                }
                else {
                    echo '<p style="padding:25px;">' . $username . ', nemate dovoljna prava za pristup ovoj stranici.' . '</p>';
                }
            } else {
                #echo ('Neuspjesan login');
                echo '<a style="padding:14px 16px; text-decoration: none; color: white; background-color: #064B71; margin-top: 25px;" href="registracija.html">REGISTRIRAJ SE</a>';
            }
        }
        else {
            #echo ('Neuspjesan login');
            echo '<a style="padding:14px 16px; text-decoration: none; color: white; background-color: #064B71; margin-top: 25px;" href="registracija.html">REGISTRIRAJ SE</a>';
        }
        ?>
        </section>
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