<?PHP
require('connect.php');
require('nav.php');
?>
<div class = 'container'>
<?PHP
if(isset($_SESSION['active'])) {
?>
    <center>
    <h1><font color = '#38A2C3'>Logging out...</font></h1>
    <div class = 'form'>
        Please come back soon!
<?PHP
    header("refresh:3;url=home.php");
}
session_destroy();
?>
</div>
