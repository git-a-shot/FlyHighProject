<?php
include ("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nomineeID'])) {
  $nomineeID = $_GET['nomineeID'];
  $sql = "UPDATE nomineeinfo SET aprv_conf = 'Approved, Confirmed' WHERE nomineeID = $nomineeID";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Nominee confirmed successfully!');</script>";
    header("Refresh:0; url=empNomDetail.php"); 
  } else {
    echo "Error updating record: " . $conn->error;
  }
} else {
  echo "Invalid request";
}
$conn->close();
?>
