<?php
    require_once("DB/database.php");
    $conn = DBconnect();
    $produkt = getProdukt($conn, $_GET["id"]);
    DBdestroy($conn);
    if($produkt->num_rows == 0) {header("Location: http://localhost/Semestralka/sem/404.php");}

    $prod = "";
    while($item=$produkt->fetch_assoc()) 
    {
        $prod = $item;
    }
    include_once("includes/header.html");
?>
    <div class="container">
        <div class="row">
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <div class="card mt-4">
                    <img class="card-img-top img-fluid" id="gnprod" src="<?php echo $prod["imgURL"]; ?>" alt="">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $prod["nazov"]; ?></h3>
                        <h4><?php echo $prod["cena"]; ?>€</h4>
                        <p class="card-text"><?php echo $prod["popis"]; ?></p>
                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
                        5 stars
                    </div>
                </div>
            </div>
            <!-- /.col-lg-9 -->
        </div>
    </div>

<?php  
    include_once("includes/footer.html");
?>