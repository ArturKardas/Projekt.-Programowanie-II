<?php
    session_start();

    require_once "connect.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
    }
    else{
        $_SESSION['id'] = $_POST['id'];


                $sql1 = "SELECT MAX(idZawodnicy) as id FROM zawodnicy";

                if($rezultat1 = @$polaczenie->query($sql1)){
                    $liczba = $rezultat1->fetch_assoc();
                    $sql2 = "DELETE FROM druzyna.zawodnicy WHERE idZawodnicy = ".$_SESSION['id'].";";
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