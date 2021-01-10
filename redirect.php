<?php
require 'includes/functions.php';

if(count($_POST) > 0)
{
    if($_GET['from'] == 'login')
    {
        $found = false; // assume not found

        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);

        if(checkUsername($user))
        {
            $found = findUser($user, $pass);

            if($found)
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user;
                header('Location: thankyou.php?from=login&username='.filterUserName($user));
                exit();
            }
        }

        setcookie('error_message', 'Login not found! Try again.');
        header('Location: login.php');
        exit();
    }
    elseif($_GET['from'] == 'signup')
    {
        if(checkSignUp($_POST) && saveUser($_POST))
        {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = trim($_POST['username']);
            header('Location: thankyou.php?from=signup&username='.filterUserName(trim($_POST['username'])));
            exit();
        }

        setcookie('error_message', 'Unable to sign up at this time.');
        header('Location: signup.php');
        exit();
    }

    elseif($_GET['from'] == 'reset')
    {   
        $user = trim($_POST['username']);
        $pass = trim($_POST['password']);
        $myfile = fopen("newfile.txt", "w") ;
        fwrite($myfile, $user);
        fwrite($myfile, $pass);
        fclose($myfile);
        session_start();
        if(($_SESSION['username'] == 'Administrator') || ($_SESSION['username'] == 'administrator'))
        {
            if(checkReset($_POST) && adminUpdate($user, $pass))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                header('Location: thankyou.php?from=reset&username='.filterUserName(trim($_POST['username'])));
                exit();
            }

            setcookie('error_message', 'Unable to reset at this time.');

            header('Location: reset.php?queryR='.$_POST['username'].'');
            exit();
        }
        else
        {
            if(checkReset($_POST) && userUpdate($_POST))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = trim($_POST['username']);
                header('Location: thankyou.php?from=reset&username='.filterUserName(trim($_POST['username'])));
                exit();
            }

            setcookie('error_message', 'Unable to reset at this time.');

            header('Location: reset.php?queryR='.$_POST['username'].'');
            exit();
        }
    }
}

header('Location: index.php');
exit();
