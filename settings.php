<?PHP 
require('connect.php');
require('nav.php');
?>

<div class = 'container'>
<?PHP 
$sessionID = $row['user_id'];
if((isset($_POST['opass'])) && (isset($_POST['npass'])) && (isset($_POST['npass2']))) {
    if((!empty($_POST['opass'])) && (!empty($_POST['npass'])) && (!empty($_POST['npass2']))){
        $oldpass = sanitize($_POST['opass']);
        $newpass = sanitize($_POST['npass']);
        $newpass2 = sanitize($_POST['npass2']);
        $sql = "SELECT * FROM Users WHERE user_id = '{$sessionID}'";
        if($res = $db->query($sql)) {
            if($row = $res->fetch_assoc()) {
                if($oldpass == $row['user_password']) {
                    if($newpass == $newpass2) {
                       $sql = "UPDATE Users SET user_password = '{$newpass}' WHERE user_id = '{$sessionID}'"; 
                        if($res = ($db->query($sql))) {
                            $passwordChange = true;
                        } else { 
                            $passwordChange = false;
                        }
                    }
                }
            }
        }
    }
}
if(isset($_SESSION['active'])) {
?>
    <center>
    <h1><font color = '#38A2C3'>Account Settings</font></h1>
<?PHP 
if($passwordChange == false) {
?> 
    <form id = 'changepass' method = 'POST'>
        <div class = 'form'>
            <center><h1>Update Password</h1>
            <br>
            Current Passowrd: 
            <input type = 'password' id = 'opass' name = 'opass' value = ''>
            <br><br>    
            New Password:
            <input type = 'password' id = 'npass' name = 'npass' value = ''>
            <br><br>    
            Confirm Passowrd: 
            <input type = 'passwpord' id = 'npass2' name = 'npass2' value = ''>
            <br><br>
            <button type = 'submit'>FINALIZE</button>    
<?PHP 
} else { 
?>
            <font color = green><h1>SUCCESS!</font></h1>
            <?PHP $passwordChange = true;?> 
       </div>
    </form>
<?PHP
}}
?>

