<html>
    <head>
<style>
            body {background-color: cornsilk}
            h1 {color: black}
            p {color: black}
            table {background-color: beige}
        </style>
    </head>

<?php
include 'functions.dat';
$userfile = 'login.dat';
$is_logged_in = false;
$all_users_info =load_users_info($userfile);

// validate user info
$errors = array();
if (array_key_exists('register_valid', $_POST)) {

//$username_entered = $password_entered = $confirmed_password= "";

  $username_entered = $_POST["username"];
  $password_entered = $_POST["password"];
  $confirmed_password =$_POST["confirm_password"];
  $email_entered=$_POST['email'];
  
// if no name is inputted than a username required error appears
    if(empty($_POST['username'])){
        $errors['username']['field_required'] = "Username required." ;
    }
// check to see if username already exists and if it does then display an error
    else{ 
        if(array_key_exists(strtolower($username_entered), $all_users_info)) {
        $errors['username']['username_exists'] = "Error: Username already exists.";
    }
    }
// check to see if username has illegal characters (no commas) & is correct length (4-11)
    if(!preg_match('/^\w{4,11}$/',$_POST['username'])){
      $errors['username']['username_invalid'] = "Error: Please enter a username consist of letters and numbers.";
      }
     
    $password_entered = $_POST['password'];
    
// if no password is inputted display a 'password required' error
    if(empty($_POST['password'])){
        $errors['password']['field_required'] = "Password required.";
    }
    else{
// check to see if password is at least 6 characters and if its less than 6 display an error
        if(strlen($_POST['password'])<6){
    $errors['password']['password_length']= " <Error: Password must have minimum 6 characters.";
    }
    }
// confirm password must be inputted if not display 'confirm password' error 
    if(empty($_POST['confirm_password'])){
        $errors['confirm_password']['field_required']= "Confirm password.";
    }
    else{
// check to see if password is the same as before
    $confirmed_password = $_POST['confirm_password'];
    
// make sure password is case sensitive & both passwords entered match   
    $password1 = $_POST['password'];
    $password2 = $_POST['confirm_password'];
// if the both passwords aren't the same display error 'passwords do not match'
    if($password1 != $password2){
        $errors['confirm_password']['passwords_dont_match'] = "Error: Passwords do not match.";
    }}
    
//validate email    
//save username and password to files 
    if (empty($errors)) {
        // save the registration data
        $new_user_info = array('username' => $username_entered, 'password' => $password_entered,'email'=>$email_entered);
        add_new_user($userfile, $new_user_info);
        $is_logged_in = true;
        header('location:invoice.php?'.$_SERVER['QUERY_STRING']);
 
        }
    }

// if errors array is not empty, then show this registration 
if ($is_logged_in == FALSE) {
    ?>
      <body background="./imgs/homer-simpson-beer-mug-wallpaper-2.jpg" opacity: 1.0;>
          
            <h1>Please fill out information below to buy beer:<br></h1>
            <form action = '<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>' method="POST">

            
        <br>Username: <input type="text" name="username"/>
        <?php
        if (isset($errors['username'])) {
            print implode('<br>', $errors['username']);
        }
        ?>
        <br>
        <br>
        Password: <input type="password" name="password"/>
        <?php
        if (isset($errors['password'])) {
            print implode('<br>', $errors['password']);
        }
        ?>  
        <br>
        <br>
        Confirm Password: <input type="password" name="confirm_password"/>
        <?php
        if (isset($errors['confirm_password'])) {
            print implode('<br>', $errors['confirm_password']);
        }
        ?>
        <br>        
        <br>
        Enter email: <input type="email" name="email"/>
        <?php
        if (isset($errors['email'])) {
            print implode('<br>', $errors['email']);
        }
        ?>
        <br>
        <br>
        
        <input type="submit" name="register_valid" value="Register">
    </form>
        <?php
}
    ?>
    
</html>