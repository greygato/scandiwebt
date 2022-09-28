<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "scandiweb_test");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" id="product_form" action="index.php?action=add">
    <header>
        <div class="header1"><h1>Product Add</h1></a></div>
        <div class="header2">
            <button type="submit" id="save">Save</button>
            <a href="index.php" id="cancel">Cancel</a>
        </div>
        <hr/><br/>
    </header>
    <main>
            <label for="sku">SKU</label><br/>
            <input name="sku" id="sku" class="txt" required/>
            <br/><br/>
            <label for="name">Name</label><br/>
            <input name="name" id="name" class="txt" required/>
            <br/><br/>
            <label for="price">Price</label><br/>
            <input type="number" name="price" id="price" class="num" required/>
            <br/><br/>

            <select id='productType'>
                <option id='DVD'>DVD</option>
                <option id='Furniture'>Furniture</option>
                <option id='Book'>Book</option>
            </select>
            <br/><br/>

            <div id="xinfo"></div>

            <?php
                if(isset($_GET['action'])){
                    if($_GET['action'] == "skualert"){
                        echo "<p style='color:yellow'>Please provide a unique SKU for the new product.</p>";
                    }
                }
            ?>

            <script>
                var sku = document.getElementById("sku");
                var name = document.getElementById("name");
                var price = document.getElementById("price");
                var save = document.getElementById("save");
                var inps = document.getElementById("product_form").elements;
                var productType = document.getElementById("productType");
                var container = document.getElementById("xinfo");

                var DVD = { params: ["size"], l: 1, desc: "Please, provide size in megabytes.", pt: 1 };
                var Book = { params: ["weight"], l: 1, desc: "Please, provide weight in kilograms.", pt: 2 };
                var Furniture = { params: ["height", "width", "length"], l: 3, desc: "Please, provide dimensions in HxWxL format.", pt: 3 };

                function extraParams(){
                    while (container.hasChildNodes()) {
                        container.removeChild(container.lastChild);
                    }
                    for(var i = 0; i < window[productType.value].l; i++){
                        var lbl = document.createElement("label");
                        lbl.for = window[productType.value].params[i];
                        lbl.innerHTML = window[productType.value].params[i];
                        var inp = document.createElement("input");
                        inp.setAttribute("type", "number");
                        inp.setAttribute("name", window[productType.value].params[i]);
                        inp.setAttribute("class", "num");
                        inp.setAttribute("required", true);
                        container.appendChild(lbl);
                        container.innerHTML += "<br/>";
                        container.appendChild(inp);
                        container.innerHTML += "<br/><br/>";
                    }
                    var desc = document.createElement("p");
                    desc.innerHTML = window[productType.value].desc;
                    container.appendChild(desc);

                    var pt = document.createElement("input");
                    pt.value = window[productType.value].pt;
                    pt.setAttribute("type", "hidden");
                    pt.setAttribute("name", "productType");
                    container.appendChild(pt);
                }
                extraParams();
                productType.addEventListener("change", function(){ extraParams(); });

                /*function isFilled(){
                    var flag1 = false;
                    var flag2 = false;

                    for(const inp of inps){
                        if(inp == null){
                            flag1 = true;
                        }
                        if(inp.classList.contains("num") && typeof inp.value == "string"){
                            container.innerHTML += typeof inp.value;
                            flag2 = true;
                        }
                        if(inp.classList.contains("txt") && typeof inp.value == "number"){
                            flag2 = true;
                        }
                    }

                    if(flag1){
                        alert("Please, submit required data");
                        return false;
                    }
                    if(flag2){
                        alert("Please, provide the data of indicated type");
                        return false;
                    }
                    else{
                        return true;
                    }
                }*/

                /*function isUnique(){
                    if(in_array(sku.value, $_SESSION['skus'])){
                        alert("Please enter a unique SKU for the product.");
                        return false;
                    }
                    container.innerHTML += sku.value;
                    return false;
                }*/
            </script>
        </form>
    </main>
    <hr/>
    <footer>
        <p class="footer">Scandiweb Test assignment</p>
    </footer>
</body>
</html>