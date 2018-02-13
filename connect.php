<?PHP 
define(HOST, 'localhost');
define(USERNAME, 'bmirkazemi');
define(PW, 'ronaldo');
define(DB, 'bmirkazemi');
define(IMG_DIR, './images/');
define(IMG_DIR2, './jerseys/');
define(IMG_DIR3, './merch/');

$db = mysqli_connect(HOST, USERNAME, PW, DB);
if ($db) {
    //bueno
} else {
    exit(1);
}
?>
