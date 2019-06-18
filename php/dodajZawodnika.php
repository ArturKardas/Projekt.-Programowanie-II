<?php
    session_start();

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
    }
    else{
        $_SESSION['numer'] = $_POST['numer'];
        $_SESSION['imie'] = $_POST['imie'];
        $_SESSION['nazwisko'] = $_POST['nazwisko'];
        $_SESSION['pozycja'] = $_POST['pozycja'];
        $_SESSION['druzyna'] = $_POST['druzyna'];
        $_SESSION['trener'] = $_POST['trener'];


                $sql1 = "SELECT MAX(idZawodnicy) as id FROM zawodnicy";

                if($rezultat1 = @$polaczenie->query($sql1)){
                    $liczba = $rezultat1->fetch_assoc();
                    $id = $liczba['id']+1;
                    $sql2 = "INSERT INTO zawodnicy (idZawodnicy, imie, nazwisko, numerKoszulki, pozycja, druzyna, trenerzy_idtrenerzy)
                             VALUES ('$id', '".$_SESSION['imie']."', '".$_SESSION['nazwisko']."', '".$_SESSION['numer']."','".$_SESSION['pozycja']."','".$_SESSION['druzyna']."','".$_SESSION['trener']."');";
                    if($rezultat2 = @$polaczenie->multi_query($sql2)){
                         $_SESSION['bladRej'] = '<span style="color: red">Git! </span>';
                    }
                    else{
                         $_SESSION['bladRej'] = '<span style="color: red">Shit! </span>';
                    }
                }

                unset($_SESSION['blad']);
                $rezultat1->close();

                //header('Location: gra.php');



    $polaczenie->close();

    //$_SESSION['rejestracja'] = '<span style="color: red">Zostałes zarejestrowany. Teraz proszę się zalogować.</span>';
    header('Location: http://localhost/Projekt/index.php');
    exit();
    }
?>