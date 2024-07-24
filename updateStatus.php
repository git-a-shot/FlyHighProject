<?php
include('connection.php');
$sql_update = "UPDATE nomineeinfo SET aprv_conf = 'Approved' where aprv_conf = 'Approved, Confirmed' ";
if (mysqli_query($conn, $sql_update)) {
    echo "<script>alert('Successfully Updated ');
    window.location.href = 'dashboard.html'</script>";;
} else {
    echo "<script>alert('Error updating quota: " . mysqli_error($conn) . "');</script>";
}
$conn->close();
?>