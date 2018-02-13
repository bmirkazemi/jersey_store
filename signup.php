<?PHP
require('connect.php');
require('nav.php');
?>

<?PHP
if(isset($_SESSION['active'])) {
    header("Location: ./home.php");
}

if(!empty($_POST['firstname']) && !empty($_POST['username']) && 
    !empty($_POST['password']) && !empty($_POST['cpassword']) && 
    !empty($_POST['email'])) {
    
    $exists = false;
    $added = false;
    $dontmatch = false;

    $firstname = sanitize($_POST['firstname']);
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    $cpassword = sanitize($_POST['password']);
    $email = sanitize($_POST['email']);
    if ($password != $cpassword) {
        $dontmatch = true;
    }
    if ($dontmatch == false) {
        $sql = "SELECT * FROM Users WHERE user_uname = '{$username}' 
            OR user_email = '{$email}'";
        if ($res = ($db->query($sql))) {
            if ($row = $res->fetch_assoc()) {
                $exists = true;
                //user exists already
                
            } else {
                $sql = "INSERT INTO Users (user_uname, user_email, user_password
                    ) VALUES ('{$username}', '{$email}', '{$password}')";
            }
            if ($res = ($db->query($sql))) {
                $added = true;
            }
        }
    }
}


?>

<div class = 'container'>
    <center>
    <h1><font color = '#38A2C3'>Please Enter Your Information</font></h1><br>
    <form class = 'form' id= 'login' method = 'POST'>
        First Name : <input type = 'text' id = 'firstname' name = 'firstname' value = '<?PHP echo $_POST['firstname'];?>'><br>
        <br>
        Username : <input type = 'text' id = 'username' name = 'username' value = '<?PHP echo $_POST['username'];?>'><br>
        <br>
        Password : <input type = 'password' id = 'password' name = 'password' value = ><br>
        <br>
        Confirm : <input type = 'password' id = 'cpassword' name = 'cpassword' value = ><br>
        <br>    
        E-Mail : <input type = 'text' id = 'email' name = 'email' value = '<?PHP echo $_POST['email'];?>'><br>
        <center><br>
        <input type = 'submit' value = 'SUBMIT'>
<?PHP
if($added) {
    echo "<h1>Redirecting to Login...</h1>";
    header("refresh:3;url=login.php");
} 
?>
        </center>
</div>
