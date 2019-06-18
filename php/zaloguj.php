<?php
    session_start();
    unset($_SESSION['rejestracja']);

    require_once "connect1.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
    }
    else{
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        $sql = "SELECT u.* , w.* FROM uzytkownicy u , wojsko w WHERE u.id = w.graczId AND user='$login' AND pass='$pass'";


        if($rezultat = @$polaczenie->query($sql))
        {
            $ilu_userow = $rezultat->num_rows;

            if($ilu_userow>0){
                $_SESSION['zalogowany'] = true;
                $wiersz = $rezultat->fetch_assoc();
                $_SESSION['imie'] = $wiersz['user'];

                unset($_SESSION['blad']);
                $_SESSION['bladRej'] = '<span style="color: white; font-size: 2vw;">Zalogowałeś się!!</span>';
                $rezultat->close();
                header('Location: http://localhost/Projekt/index.php');
            }
            else{
                $_SESSION['bladRej'] = '<span style="color: white; font-size: 2vw;">Nieprawidłowy login lub hasło! </span>';
                header('Location: http://localhost/Projekt/index.php');
            }

        }

        $polaczenie->close();
    }
?>