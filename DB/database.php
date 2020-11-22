<?php
    

function DBconnect()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "checkpoint2";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  return $conn;
}

function DBdestroy($conn) 
{
  $conn->close();
}

function selectAllProducts($conn)
{
  $sql = "SELECT * FROM produkty";

  $result = $conn->query($sql);
  return $result;
}

function addProdukt($body, $conn)
{
  $nazov = $body['nazov'];
  $popis = $body['popis'];
  $cena = $body['cena'];
  $imgURL = $body['imgURL'];

  $sql = "INSERT INTO produkty (nazov, popis, cena, imgURL) VALUES ('$nazov', '$popis', '$cena', '$imgURL')";
  $result = $conn->query($sql);
  return $result;
}

function getProdukt($conn, $id) 
{
  $sql = "SELECT * FROM produkty WHERE id = " .$id;
  $result = $conn->query($sql);
  return $result;
}

function editProdukt($body, $conn)
{
  $nazov = $body['nazov'];
  $popis = $body['popis'];
  $cena = $body['cena'];
  $imgURL = $body['imgURL'];
  $id = $body['id'];

  $sql = "UPDATE produkty SET nazov='$nazov', cena='$cena', imgURL='$imgURL',popis='$popis' WHERE id=" . $id;
  $result = $conn->query($sql);
  return $result;
}

function deleteProdukt($id, $conn)
{
  $sql = "DELETE FROM produkty WHERE id=" . $id;
  $result = $conn->query($sql);
  return $result;
}

function kontrolaSTR($data)
{
  if (!empty($data)) {
    $data = trim(htmlspecialchars($data)); 
    return true;
  }  
  return false;
}

function kontrolaINT($data)
{
  if (!empty($data)) {
    $check = filter_var($data , FILTER_VALIDATE_INT);    
    return $check;
  }
  return false;
}

function kontrolaURL($data)
{
  if (!empty($data)) {
    $check = filter_var($data , FILTER_VALIDATE_URL);    
    return $check;
  }
  return false;
}
?>