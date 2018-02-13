<?PHP 
require('connect.php');
require('nav.php');
?>

<div class = 'container'>
<?PHP 
if(isset($_SESSION['active'])) {
?>
    <center>
    <h1><font color = '#38A2C3'>Login Successful!</font></h1>
    <div class = 'form'>
        Welcome to the store, <?PHP echo $_SESSION['firstname'];?>.
    </div>
<?PHP 
} else {
?>
    <center>
    <h1><font color = '#38A2C3'>Welcome Guest</font></h1>
    <div class = 'form'>
        Please Login
    </div>
<?PHP } ?>
