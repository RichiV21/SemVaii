<?php
  require_once("DB/database.php");
  $conn = DBconnect();
  if(isset($_POST["delete"]))
  {
    
    $result = deleteProdukt($_POST["id"], $conn);
    
  }
  
  $produkty = selectAllProducts($conn);
  DBdestroy($conn);
  
?>
<?php
  include_once("includes/header.html");
?>

  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="row">

          <!--<div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="produkt.html"><img class="card-img-top" src="img/goldstandard.jpg" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="produkt.html">Srvátkový whey proteín</a>
                </h4>
                <h5>45,99€</h5>
                <p class="card-text">Víťaz ceny proteín roka 11 krát po sebe
                </p>
              </div>
            </div>
          </div>
-->
<?php
  if ($produkty->num_rows > 0) {
  // output data of each row
    while($produkt = $produkty->fetch_assoc()) {
      echo "<div class='col-lg-4 col-md-6 mb-4'>
      <div class='card h-100'>
        <a href='produkt.php?id=".$produkt["id"]."'><img class='card-img-top' src='".$produkt["imgURL"]."' alt=''></a>
        <div class='card-body'>
          <h4 class='card-title'>
            <a href='produkt.php?id=".$produkt["id"]."'>".$produkt["nazov"]."</a>
          </h4>
          <h5>".$produkt["cena"]."€</h5>
          <p class='card-text'>".$produkt["popis"]."
          </p>
        </div>
      </div>
      <a href='addProdukt.php?edit=".$produkt["id"]."'>Upraviť</a>
      <form action='http://localhost/Semestralka/sem/' method='POST'>
      <button type='submit'>Vymazať</button>
      <input type='hidden' name='delete' value='true'>
      <input type='hidden' name='id' value='".$produkt["id"]."'>
      </form>
    </div>";
    }
  } else {
    echo "0 results";
  }
?>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
  </div>

<?php
  include_once("includes/footer.html");
?>