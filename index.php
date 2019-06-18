<?php
    session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>FC CSS</title>
    <meta name="keywords" content="Programowanie 2" />
    <meta name="description" content="Strona służąca do zaliczenia Projektu" />
    <meta name="author" content="Artur Kardas" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="Classification" content="learn">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/kadra.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
</head>

<body>

    <?php
        if(isset($_SESSION['bladRej'])) {
            echo $_SESSION['bladRej'];
        };
        unset($_SESSION['bladRej']);
    ?>

    <div id="up">
        <div id="logo">
            <div id="logo_napis" onclick="news();">FC CSS</div>
        </div>
        <div id="menu">
            <div id="menuNews" class="menu" onclick="news();">News</div>
            <div id="menuTerminarz" class="menu" onclick="terminarz();">Terminarz</div>
            <div id="menuTabela" class="menu" onclick="tabela();">Tabela</div>
            <div id="menuKadra" class="menu" onclick="kadra();">Kadra</div>
            <div id="zaloguj" class="menu">
                <?php
                    if (isset($_SESSION['zalogowany'])) {
                        echo '<div class="wyloguj">Witaj  '.$_SESSION['imie'].'!</div>';
                        echo '<div class="wyloguj"><a href="php/logout.php">[WYLOGUJ]</a></div>';
                    }
                    else{
                        echo '<form action="php/zaloguj.php" class="zaloguj" method="post">';
                        echo    '<div class="linia">';
                        echo        '<label for="field-login" class="zal">Login:</label>';
                        echo        '<input type="text" name="login"/>';
                        echo    '</div>';
                        echo    '<div class="linia">';
                        echo        '<label for="field-pass" class="zal">Pass:</label>';
                        echo        '<input type="password" name="pass"/>';
                        echo    '</div>';
                        echo    '<div class="linia">';
                        echo        '<input type="submit" value="sing in">';
                        echo    '</div>';
                        echo'</form>';
                    }
                ?>
            </div>

        </div>
    </div>

    <div id="main">

        <div id="news">
                <h1 class="header">Aktualności z klubu</h1>
                <div class="new">
                    <h3 class="newsHeader">WYGRALIŚMY DERBY!!!</h3>
                    <a href="https://sportowefakty.wp.pl/pilka-nozna" target="_blank"><img class="newsContent" id="newsImg" src="img/news.jpg"></a>
                    <div class="newsContent" id="newsText"><p>Dziś nasi chłopcy wygrali mecz derbowy z HTML United wynikiem 3-0 i zapewnili sobie awans do rozgrywek playoff.</p></div>
                </div>

                <div id="link">
                    <a href="https://pl.wikipedia.org/wiki/Pi%C5%82ka_no%C5%BCna" target="_blank"><div id="testA" class="test-block">Historia piłki nożnej.</div></a>
                </div>


        </div>
        <div id="terminarz">
            <h1 class="header">Terminarz</h1>

            <table id="tableTerminarz">
                <tr id="tableHeader">
                    <td colspan="4">Kolejka nr.9</td>
                </tr>

                <tr>
                    <td>GOSPODARZE</td>
                    <td colspan="2">WYNIK</td>
                    <td>GOŚCIE</td>
                </tr>
                <tr>
                    <td>MAN UNT</td>
                    <td>2</td>
                    <td>0</td>
                    <td>RM</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">FC CSS</td>
                    <td>3</td>
                    <td>0</td>
                    <td>HTML United</td>
                </tr>
                <tr>
                    <td>Kopiemy bo możemy</td>
                    <td>0</td>
                    <td>0</td>
                    <td>Nie dla nas porażka FC</td>
                </tr>
                <tr>
                    <td>Ktoś na piwo</td>
                    <td>5</td>
                    <td>4</td>
                    <td>Alkoholicy LKS</td>
                </tr>
                <tr>
                    <td>MOżna?</td>
                    <td>2</td>
                    <td>2</td>
                    <td>PKP Polska</td>
                </tr>
                <tr>
                    <td>Czy to my?</td>
                    <td>1</td>
                    <td>4</td>
                    <td>OH NIEE</td>
                </tr>
            </table>
        </div>

        <div id="tabela">
            <h1 class="header">Tabela</h1>
                    <?php
                                require_once "php/connect.php";

                                $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

                                if($polaczenie->connect_errno!=0)
                                {
                                    echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
                                }
                                else{

                                     $sql = "SELECT * FROM tabela ORDER BY punkty desc;";

                                    $tabela=@$polaczenie->query($sql);
                                    $pozycja = 0;
                                    echo '<table id="kadraTable" >';
                                    echo '<tr>';
                                    echo'<td colspan="6">Tabela</td>';
                                    echo "</tr>";
                                    echo '<tr>';
                                    echo"<td>POZYCJA</td><td>NAZWA</td><td>PUNKTY</td><td>GOLE +</td><td>GOLE -</td><td>MECZE</td>";
                                    echo "</tr>";
                                    while($row = $tabela->fetch_array()){
                                        $pozycja++;
                                        echo '<tr>';
                                        echo"<td>".$pozycja."</td><td>".$row['nazwa_klub']."</td><td>".$row['punkty']."</td><td>".$row['gole_zdobyte']."</td><td>".$row['gole_stracone']."</td><td>".$row['rozegrane_mecze']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                $tabela->close();
                                $polaczenie->close();
                        ?>
        </div>

        <div id="kadra">
            <h1 class="header">Nasz zespół</h1>
            <div id="zawodnicyBlock">
                <?php
                        require_once "php/connect.php";

                        $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

                        if($polaczenie->connect_errno!=0)
                        {
                            echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
                        }
                        else{

                            $sql = "SELECT * FROM zawodnicy;";

                            $tabela=@$polaczenie->query($sql);

                            echo '<table id="kadraTable">';
                            echo '<tr>';
                                echo'<td colspan="5">Zawodnicy</td>';
                            echo "</tr>";
                            echo '<tr>';
                                echo"<td>ID</td><td>NUMER</td><td>IMIĘ</td><td>NAZWISKO</td><td>POZYCJA</td>";
                            echo "</tr>";
                            while($row = $tabela->fetch_array()){
                                echo '<tr>';
                                echo"<td>".$row['idZawodnicy']."</td><td>".$row['numerKoszulki']."</td><td>".$row['imie']."</td><td>".$row['nazwisko']."</td><td>".$row['pozycja']."</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        $tabela->close();
                        $polaczenie->close();
                ?>
                <div id="zarzadzanieTab">
                    <?php
                        if (isset($_SESSION['zalogowany'])) {
                            echo '<div id="dodaj" class="guzikiTab" onclick="dodaj();">DODAJ</div>';
                            echo ' <div id="usun" class="guzikiTab" onclick="usun();">USUŃ</div>';
                            echo '<div id="edytuj" class="guzikiTab" onclick="edytuj();">EDYTUJ</div>';
                        }
                    ?>
                </div>
                <div id="dodajZawodnik">
                        <form class="form1" action="php/dodajZawodnika.php" method="post">
                            <div class="form-row">
                                <label for="field-numer" class="col">Numer*</label>
                                <input type="number" name="numer" required id="field-name" data-error="Wypełnij to pole" pattern="[1-9]+">
                            </div>
                            <div class="form-row">
                                <label for="field-imie" class="col">Imie*</label>
                                <input type="text" name="imie" required id="field-imie" data-error="Wypełnij to pole" pattern="[a-zA-ZąĄććęęłŁńŃóÓśŚżŻŹŹ ]+">

                            </div>
                            <div class="form-row">
                                <label for="field-nazwisko" class="col">Nazwisko*</label>
                                <input type="text" name="nazwisko" required id="field-nazwisko" data-error="Wypełnij to pole" pattern="[a-zA-ZąĄććęęłŁńŃóÓśŚżŻŹŹ ]+">

                            </div>
                            <div class="form-row">
                                <label for="field-pozycja" class="col">Pozycja*</label>
                                    <div class="pozycja"><input type="radio" name="pozycja" value="bramkarz" required>
                                        <div class="opispozycji">bramkarz</div>
                                    </div>

                                    <div class="pozycja"><input type="radio" name="pozycja" value="obronca" required>
                                        <div class="opispozycji">obrońca</div>
                                    </div>

                                    <div class="pozycja"><input type="radio" name="pozycja" value="pomocnik" required>
                                        <div class="opispozycji">pomocnik</div>
                                    </div>

                                    <div class="pozycja"><input type="radio" name="pozycja" value="napastnik" required>
                                        <div class="opispozycji">napastnik</div>
                                    </div>
                            </div>
                            <div class="form-row">
                                <label for="field-druzyna" class="col">Team*</label>
                                    <div class="pozycja"><input type="radio" name="druzyna" value="senior" required>
                                        <div class="opispozycji">senior</div>
                                    </div>

                                    <div class="pozycja"><input type="radio" name="druzyna" value="junior" required>
                                        <div class="opispozycji">junior</div>
                                    </div>
                            </div>
                            <div class="form-row">
                                <label for="field-trener" class="col">Trener*</label>
                                    <div class="pozycja"><input type="radio" name="trener" value="1" required>
                                        <div class="opispozycji">seniorów</div>
                                    </div>

                                    <div class="pozycja"><input type="radio" name="trener" value="2" required>
                                        <div class="opispozycji">juniorów</div>
                                    </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="submit-btn">DODAJ</button>
                            </div>

                        </form>
                </div>
                <div class="form1" id="usunZawodnik">
                        <form action="php/usunZawodnika.php" method="post">
                            <div class="form-row">
                                <label for="field-id" id="label-id" class="col">Podaj proszę numer ID zawodnika do usunięcia.</label>
                                <input type="number" name="id" required id="field-id" data-error="Wypełnij to pole" pattern="[1-9]+">
                            </div>

                            <div class="form-row">
                                <button type="submit" class="submit-btn">USUŃ</button>
                            </div>
                        </form>
                </div>
                <div id="edytujZawodnik">

                </div>
            </div>

            <div id="trenerzyBlock">

                            <?php
                                require_once "php/connect.php";

                                $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

                                if($polaczenie->connect_errno!=0)
                                {
                                    echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
                                }
                                else{

                                     $sql = "SELECT * FROM trenerzy;";

                                    $tabela=@$polaczenie->query($sql);

                                    echo '<table id="kadraTable" class="trenerzy">';
                                    echo '<tr>';
                                    echo'<td colspan="4">Trenerzy</td>';
                                    echo "</tr>";
                                    echo '<tr>';
                                    echo"<td>ID</td><td>IMIĘ</td><td>NAZWISKO</td><td>DRUŻYNA</td>";
                                    echo "</tr>";
                                    while($row = $tabela->fetch_array()){
                                        echo '<tr>';
                                        echo"<td>".$row['idtrenerzy']."</td><td>".$row['imie']."</td><td>".$row['nazwisko']."</td><td>".$row['druzyna']."</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                $tabela->close();
                                $polaczenie->close();
                        ?>

            </div>

        </div>
    </div>
     <div>
                    <form class="form" id="contactForm" method="post" action="php/plik.php" ENCTYPE="multipart/form-data">
                            <div class="form-row">
                                <label for="field-name" class="col">Name*</label>
                                <input type="text" name="name"  id="field-name1" data-error="Wypełnij to pole" pattern="[a-zA-ZąĄććęęłŁńŃóÓśŚżŻŹŹ ]+">
                            </div>
                            <div class="form-row">
                                <label for="field-plik" class="col">Plik*</label>
                                <input type="file" name="plik" required id="field-plik" data-error="Wprowadź plik." ">
                            </div>
                            <div class="form-row">
                                <label for="field-message" class="col">Message*</label>
                                <textarea name="message"  data-error="Musisz wypełnić pole" id="field-message" pattern=".+"></textarea>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="submit-btn">Wyślij</button>
                            </div>

                    </form>

                    <form class="form" id="registerForm" action="php/rejestracja.php" method="post">
                        <div class="form-row">
                                <label for="field-login" class="col">Login*</label>
                                <input type="text" name="loginRej" id="field-login" pattern="[a-zA-Zęóąśżźćńł]+{0,30}" maxlenght="30" title="Jedynie litery i max 30 znaków" required>
                        </div>
                        <div class="form-row">
                                <label for="field-login" class="col">Password*</label>
                                <input type="password" name="passRej" id="field-pass" pattern="[a-zA-Z0-9]+" required>
                        </div>
                        <div class="form-row">
                                <label for="field-login" class="col">E-mail*</label>
                                <input type="text" name="mailRej" id="field-mail" pattern="[a-zA-Zęóąśżźćńł]{1,30}@[a-zA-a]{1,}.{1,}"  required>
                        </div>
                        <div class="form-row">
                                <button type="submit" class="submit-btn">Rejestruj</button>
                            </div>
                    </form>

    </div>
    <script  type="text/javascript" src="js/chooseContent.js"></script>
    <script type="text/javascript"  src="js/jqueryAnime.js"></script>
</body>

</html>