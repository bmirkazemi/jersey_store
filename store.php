<?PHP 
require('connect.php');
require('nav.php');

if(!isset($_SESSION['active'])) {
    header("Location:./home.php");
}

if(isset($_GET['q']) && $_GET['q'] != '') {
    $q = sanitize($_GET['q']);
    $sql = "SELECT * FROM Products WHERE prod_id = {$q}";
    if(($res = ($db->query($sql))) == TRUE) {
        if($row = $res->fetch_assoc()) {
            echo "<center>\n";
            echo "<div class = \"jerseys\">\n";
            echo "<center>\n";
            echo "<div class = \"image\">\n";
            echo "<img src = '".IMG_DIR2.$row['prod_jer']."'>\n";
            echo "</div>\n";
            echo "<div class = \"table\">\n";
            echo "<br>".$row['prod_name']."<br>\n";
            echo "<br>Rating: ";
            for($i=0; $i < $row['prod_rating']; $i++)
                echo "*";
            if($row['prod_rating'] < 5) 
                echo "-";
            echo "<br><br>Price: ".$row['prod_price']."<br>\n";
            echo "<br>SKU : ".$row['prod_sku']."<br><br>\n";
            if($row['prod_stock'] > 0) 
                echo "IN STOCK<br>\n";
            else 
                echo "<font color = \"red\">OUT OF STOCK</font><br>\n";
            echo "</div>\n";
            echo "<div class = \"description\">\n";
            echo $row['prod_description'];
            echo "</div>\n";
?>
<form id = 'cart' action = 'cart.php' method = 'POST'>
    <input type = 'hidden' name = 'store_prod_id' value = '<?PHP echo $q;?>'>
    <input type = 'submit' value = 'add-to-cart'>
</form>
<?PHP
            echo "<a href='store.php'>Back To Store</a><br></div>\n";
        }
    }
} else {
    $sql = "SELECT * FROM Products;";
    $res = $db->query($sql);
    while($row = ($res->fetch_assoc())) {
        echo "<center>\n";
        echo "<div class = \"jerseys\">\n";
        echo "<center>\n";
        echo "<div class = \"image\">\n";
        echo "<img src = '".IMG_DIR.$row['prod_img']."'>\n";
        echo "</div>\n";
        echo "<div class = \"table\">\n";
        echo "<br>".$row['prod_name']."<br>\n";
        echo "<br>Rating: ";
        for($i=0; $i < $row['prod_rating']; $i++)
            echo "*";
        if($row['prod_rating'] < 5) 
            echo "-";
        echo "<br><br>Price: ".$row['prod_price']."<br>\n";
        echo "<br>SKU : ".$row['prod_sku']."<br><br>\n";
        if($row['prod_stock'] > 0) 
            echo "IN STOCK<br>\n";
        else 
            echo "<font color = \"red\">OUT OF STOCK</font><br>\n";
        echo "</div>\n";
        echo "<div class = \"description\">\n";
        echo $row['prod_description'];
        echo "</div>\n";
        echo "<a href='store.php?q={$row['prod_id']}'>View Jersey</a>";
        echo "</div>\n";
    }
}
    $db->close();
?>
