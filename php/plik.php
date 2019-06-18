<?php
    session_start();
    $max_rozmiar = 1024*1024;
        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
            if ($_FILES['plik']['size'] > $max_rozmiar) {
                echo 'Błąd! Plik jest za duży!';
            } else {
                echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
                echo '<br/>';
                if (isset($_FILES['plik']['type'])) {
                    echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
                    echo $_SERVER['DOCUMENT_ROOT'];
                }
                move_uploaded_file($_FILES['plik']['tmp_name'],
                $_SERVER['DOCUMENT_ROOT'].'/Projekt/wgrywanie/'.$_FILES['plik']['name']); //ściezka gdzie ma byc zapisany plik

                $_SESSION['bladRej'] = '<span  style="color: white; font-size: 2vw;">Plik został przsłany na serwer!</span>';
            }
        } else {
            $_SESSION['bladRej'] = '<span  style="color: white; font-size: 2vw;">Błąd przy przesyłaniu danych!</span>';
        }
    header('Location: http://localhost/Projekt/index.php');
?>