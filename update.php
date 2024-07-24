<?php
include('connection.php');
$sql_update = "UPDATE empinfo SET quota = 14";
if (mysqli_query($conn, $sql_update)) {
    echo "<script>alert('Successfully Updated Quota');
    window.location.href = 'dashboard.html'</script>";;
} else {
    echo "<script>alert('Error updating quota: " . mysqli_error($conn) . "');</script>";
}
$conn->close();
?>