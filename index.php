<?php
    session_start();
    $_SESSION['skus'] = array();
    $conn = mysqli_connect("localhost", "root", "", "scandiweb_test");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <form method='post' action='?action=delete'>
        <div class="header1"><h1>Product List</h1></a></div>
        <div class="header2">
            <a href="addproduct.php" id="add-product-btn">ADD</a>
            <button type="submit" id="delete-product-btn">MASS DELETE</button>
        </div>
    </header>
    <hr/><br/>

    <main>
        <?php 
            abstract class Product{
                public $id;
                public $sku;
                public $name;
                public $price;

                public function __construct($id, $sku, $name, $price){
                    $this->id = $id;
                    $this->sku = $sku;
                    $this->name = $name;
                    $this->price = $price;
                }
                public function param(){
                    echo "<div class='product'>";
                    echo "<input type='checkbox' name='deletecheckbox[]' value='".$this->id."' class='delete-checkbox'/>";
                    echo "<br/>";
                    echo $this->sku;
                    echo "<br/>";
                    echo $this->name;
                    echo "<br/>";
                    echo "". $this->price ."$";

                    array_push($_SESSION['skus'], $this->sku);
                }
            }
            class Dvd extends Product{
                public $size;
                
                public function __construct($id, $sku, $name, $price, $size){
                    $this->id = $id;
                    $this->sku = $sku;
                    $this->name = $name;
                    $this->price = $price;
                    $this->size = $size;
                }
                public function param(){
                    parent::param();
                    echo "<br/>";
                    echo "Size: ". $this->size ."MB";
                    echo "</div>";
                }
            }
            class Book extends Product{
                public $weight;

                public function __construct($id, $sku, $name, $price, $weight){
                    $this->id = $id;
                    $this->sku = $sku;
                    $this->name = $name;
                    $this->price = $price;
                    $this->weight = $weight;
                }
                public function param(){
                    parent::param();
                    echo "<br/>";
                    echo "Weight: ". $this->weight ."KG";
                    echo "</div>";
                }
            }
            class Furniture extends Product{
                public $height;
                public $width;
                public $weight;

                public function __construct($id, $sku, $name, $price, $height, $width, $length){
                    $this->id = $id;
                    $this->sku = $sku;
                    $this->name = $name;
                    $this->price = $price;
                    $this->height = $height;
                    $this->width = $width;
                    $this->length = $length;
                }
                public function param(){
                    parent::param();
                    echo "<br/>";
                    echo "Dimensions: ". $this->height ."x". $this->width ."x". $this->length;
                    echo "</div>";
                }
            }

            $sql1 = "SELECT `id`, `sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length` FROM `products` where product_type=1";
            $sql2 = "SELECT `id`, `sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length` FROM `products` where product_type=2";
            $sql3 = "SELECT `id`, `sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length` FROM `products` where product_type=3";
                $q1 = mysqli_query($conn, $sql1);
                $q2 = mysqli_query($conn, $sql2);
                $q3 = mysqli_query($conn, $sql3);
                while($row = mysqli_fetch_array($q1)){
                    $dvd = new Dvd($row['id'], $row['sku'], $row['name'], $row['price'], $row['size']);
                    $dvd->param();

                }
                while($row = mysqli_fetch_array($q2)){
                    $book = new Book($row['id'], $row['sku'], $row['name'], $row['price'], $row['weight']);
                    $book->param();
                }
                while($row = mysqli_fetch_array($q3)){
                    $fntr = new Furniture($row['id'], $row['sku'], $row['name'], $row['price'], $row['height'], $row['width'], $row['length']);
                    $fntr->param();
                }
                echo "<hr/>";
                
                if(isset($_POST['deletecheckbox'])){
                    if(isset($_GET['action']) && $_GET['action'] == "delete"){
                        foreach($_POST['deletecheckbox'] as $chkval){ 
                            $sql_d = "DELETE FROM products WHERE id = ". $chkval;
                            $q_d = mysqli_query($conn, $sql_d);
                            header("Location: index.php");
                        }
                    }
                }
    
                function replaceNull($var){
                    if(!isset($_POST[$var])){
                        return 'null';
                    }
                    else{
                        return $_POST[$var];
                    }
                }
    
                if(isset($_GET['action'])){
                    if($_GET['action'] == "add"){
                        if(in_array($_POST['sku'], $_SESSION['skus'])){
                            header("Location: addproduct.php?action=skualert");
                            die();
                        }
                        else{
                            $sqlq = "INSERT INTO `products`(`sku`, `name`, `price`, `size`, `weight`, `height`, `width`, `length`, `product_type`) 
                            VALUES ('". $_POST['sku'] ."', '". $_POST['name'] ."', ". $_POST['price'] .", ". replaceNull('size') .", ". replaceNull('weight') .", ". replaceNull('height') .", ". replaceNull('width') .", ". replaceNull('length') .", ". $_POST['productType'] .")";
                            $q_d = mysqli_query($conn, $sqlq);
                            header("Location: index.php");
                        }
                    }
                }
        ?>
        </form>
    </main>
    <footer>
        <p class="footer">Scandiweb Test assignment</p>
    </footer>
</body>
</html>