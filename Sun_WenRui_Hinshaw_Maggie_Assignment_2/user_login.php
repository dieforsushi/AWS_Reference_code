<html>
     <head>
<style> body {
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}
            body {background-color: cornsilk}
            h1 {color: black}
            p {color: black}
            table {background-color: beige}
        </style>
     <form>
         <body background="./imgs/giphy.gif" opacity: 1.0;>
     </form>
    </head>
</html>
<?php
$qstring = $_SERVER['QUERY_STRING'];
include 'functions.dat';
$is_logged_in = false;
$userfile = 'login.dat';
//check if the user data is validated 
$all_users_info = load_users_info($userfile);

if (array_key_exists('login_submit', $_POST)) {
    $username_entered = strtolower($_POST['username']);
    // make username case insensitive, convert $_POST['username'] to all uppercase  or all lowercase
    if (array_key_exists($username_entered, $all_users_info)) {
        // check to see if password matches the users info
        $user_info = $all_users_info[$username_entered];
        if ($user_info['password'] == $_POST['password']) {
            print "logged in as $username_entered<br>";
            $is_logged_in = TRUE;
        // no errors so redirect to user_login and pass the quantity data
        $qstring = http_build_query(array(
            'username' => $_POST['username'], 'quantity' => $_GET['quantity']
                )
        );
        header('location: invoice.php?' . $qstring);
        exit('There was an error loading login.php');
        die;
        }
    } 
       
    }
?>

<form action = '<?php echo $_SERVER['PHP_SELF'] . '?' . $qstring; ?>' method= 'post'>
    Username: <br>
    <INPUT TYPE="TEXT"  name="username" value = "<?php if (isset($_POST['username'])) echo $_POST['username'] ?>"><br>Password: <br>
    <INPUT TYPE="password" name = 'password'><br><br>
    <INPUT TYPE="SUBMIT" name = 'login_submit' value="Login">    
    <a href='registration.php?<?php echo $qstring; ?>' >Register</a>
</form>
