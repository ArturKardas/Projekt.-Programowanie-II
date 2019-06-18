<?php
    session_start();
    if($_SESSION['zalogowany'] == true || isset($_SESSION['zalogowany'])){
        $_SESSION['bladRej'] = '<span style="color: red; font-size: 2vw;">Nie możesz się zarejestrować gdy jesteś zalogowany!</span>';
        header('Location: http://localhost/Projekt/index.php');
        exit();
    }

    require_once "connect1.php";

    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
    }
    else{
        $_SESSION['login'] = $_POST['loginRej'];
        $_SESSION['pass'] = $_POST['passRej'];
        $_SESSION['mail'] = $_POST['mailRej'];


        $sql = "SELECT user FROM uzytkownicy WHERE user='".$_SESSION['login']."'";
        if($rezultat = @$polaczenie->query($sql))
        {
            $ilu_userow = $rezultat->num_rows;

            if($ilu_userow>0)
            {
                $_SESSION['bladRej'] = '<span style="color: white; font-size: 2vw;">Nieprawidłowy login lub hasło! </span>';
                header('Location: http://localhost/Projekt/index.php');
                $polaczenie->close();
                exit();
            }
            else{
                $sql1 = "SELECT MAX(id) as id FROM uzytkownicy";

                if($rezultat1 = @$polaczenie->query($sql1)){
                    $liczba = $rezultat1->fetch_assoc();
                    $id = $liczba['id']+1;
                    $sql2 = "INSERT INTO uzytkownicy (id, user, pass, email, drewno, kamien, zboze, dnipremium)
                             VALUES ('$id', '".$_SESSION['login']."', '".$_SESSION['pass']."', '".$_SESSION['mail']."', '2000', '2000', '2000', '0');";
                    if($rezultat2 = @$polaczenie->multi_query($sql2)){
                         $_SESSION['bladRej'] = '<span  style="color: white; font-size: 2vw;">Witaj na naszej stronie, zostałeś zarejestrowany. Teraz możesz się zalogować.</span>';
                    }
                    else{
                         $_SESSION['bladRej'] = '<span style="color: white; font-size: 2vw;">Coś poszło nie tak!! Nie zarejestrpwałeś się!</span>';
                    }
                }

                unset($_SESSION['blad']);
                $rezultat->close();
                $rezultat1->close();
                //header('Location: gra.php');
            }

        }


    $polaczenie->close();

    //$_SESSION['rejestracja'] = '<span style="color: red">Zostałes zarejestrowany. Teraz proszę się zalogować.</span>';
    header('Location: http://localhost/Projekt/index.php');
    exit();
    }
?>