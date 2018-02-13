<?PHP 
session_start();
function sanitize($data) {
    return(htmlspecialchars(stripslashes(strip_tags(trim($data)))));
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Final Project</title>
        <link rel = 'stylesheet' href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel = 'stylesheet' type = 'text/css' href= 'style.css'>
    </head>
    <body>

<?PHP 
if(isset($_SESSION['active'])) {
?>

<nav class="navbar navbar-light" style = 'border: solid #38A2C3 3px; background-color: white; 'role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">JERSEYS</a>
    </div>
      <ul class="nav navbar-nav">
        <li><a href="logout.php">Logout</a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="store.php">Jerseys</a></li>
        <li><a href="merch.php">Merchandise</a></li>
        <li><a href="cart.php">Shopping-Cart</a></li>
        <li><a href="settings.php">Account</a></li>
        </li>
      </ul>
  </div>
</nav>

<?PHP } else { ?> 

<nav class="navbar navbar-default navbar-inverse" style = 'border: solid #38A2C3 3px;'role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="./">JERSEYS</a>
        </div>
            <ul class="nav navbar-nav">
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="home.php">Home</a></li>
            </ul>
    </div>
</nav>
<?PHP } ?>
