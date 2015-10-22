<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drvotehna - Obrada drveta</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shorcut icon" href="assets/img/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "header.php" ?>
     <main class="contact-page">
        <div class="container">
            <h2>Kontakt</h2>
            <div class="contact">
                <div class="contact-info">
                    <div class="contact-section clearfix">
                        <div class="contact-type">Adrese:</div>
                        <ul class="contact-data">
                            <li>Šejkina 48đ, Beograd</li>
                            <li>Smederevski put 37, Beograd (Proizvodnja)</li>
                        </ul>
                    </div>
                    <div class="contact-section clearfix">
                        <div class="contact-type">Telefoni:</div>
                        <ul class="contact-data">
                            <li>011/3047-507</li>
                            <li>064/0262-662</li>
                            <li>063/263-793</li>
                        </ul>
                    </div>
                    <div class="contact-section clearfix">
                        <div class="contact-type">Fax:</div>
                        <ul class="contact-data">
                            <li>011/7701-671</li>
                        </ul>
                    </div>
                    <div class="contact-section clearfix">
                        <div class="contact-type">E-mail:</div>
                        <ul class="contact-data">
                            <li><a href="mailto:drvotehna@open.telekom.rs">drvotehna@open.telekom.rs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="contact-form">
                    <form action method="post" name="kontakt">
                        <input type="text" name="ime" placeholder="Ime i prezime">
                        <input type="text" name="mail" placeholder="E-mail adresa">
                        <textarea name="poruka" placeholder="Poruka"></textarea>
                        <button type="submit" name="submit" class="button"><div class="icon-mail"></div>Pošalji</button>
                    </form>

                    <?php
                    if ( isset($_POST['submit']) ) {
                        $ime = htmlspecialchars($_POST['ime']);
                        $mail = htmlspecialchars($_POST['mail']);
                        $poruka = htmlspecialchars($_POST['poruka']);
                        $ret = '';

                        if ($poruka == "") {
                            $ret = "Morate upisati tekst poruke!";
                        }

                        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $ret = "Mail adresa mora biti validna!";
                        }

                        if ($ime == "") {
                            $ret = "Morate upisati ime!";
                        }

                        if ($ret == "") {
                            $headers = "From: " . $mail . "\r\n" .
                                        "Reply-To: " . $mail . "\r\n" .
                                        "X-Mailer: PHP/" . phpversion();
                            mail('drvotehna@open.telekom.rs', 'Poruka sa sajta', $poruka, $headers);
                            $ret = 'Vaša poruka je poslata.';
                        }
                    }
                ?>

                <?php
                    if (isset($ret)) {
                        echo "<div class='contact-message'>";
                        echo "<p>{$ret}</p>";
                        echo "</div>";
                    }
                ?>
                </div>
            </div>
        </div>
    </main>
    <section class="contact-map">
        <div id="map-canvas"></div>
    </section>
    <?php include "footer.php" ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>