<?PHP
require('connect.php');
require('nav.php');
?>

<?PHP
if(isset($_SESSION['active'])) {
    header("Location: ./home.php");
}
?>

<div class = 'container'>
    <center>
    <h1><font color = '#38A2C3'>Please Log In</font></h1><br>
    <form class = 'form' id= 'login' method = 'POST'>
        Username | E-Mail : <input type = 'text' id = 'username' name = 'username' value = '<?PHP echo $_POST['username'];?>'><br>
        <br>
        Password : <input type = 'password' id = 'password' name = 'password' value = '<?PHP echo $_POST['password'];?>'><br>
        <center><br>
        <input type = 'submit' value = 'SUBMIT'>
        <br><br>
        <div id = 'error'>
<?PHP
if((isset($_POST['username'])) && (isset($_POST['password']))) {
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    $sql = "SELECT * FROM Users WHERE user_uname = '{$username}' or user_email = '{$username}'";
    if($res = $db->query($sql)) {
        if($row = $res->fetch_assoc()) {
            if($password === $row['user_password']) {
                $_SESSION['active'] = true;
                $_SESSION['username'] = $row['user_uname'];
                $_SESSION['email'] = $row['user_email'];
                $_SESSION['firstname'] = $row['user_fname'];
                header("Location: ./home.php");
            } else { echo "<font color = \"red\">INCORRECT USERNAME/PASSWORD</font><br>"; } 
        } else { echo "<font color = \"red\">INCORRECT USERNAME/PASSWORD</font><br>"; }
    }
}
?>
        </div>
        </center>
</div>
