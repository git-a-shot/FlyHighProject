<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Details</title>
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Edit Employee Details</h2>
        <?php
        include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
            $empId = $_POST['empId'];
            $sql = "SELECT * FROM empinfo WHERE empId=$empId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="edit">
            <input type="hidden" name="empId" value="<?php echo $row['empId']; ?>">
            <?php
            foreach ($row as $key => $value) {
                if ($key != 'empId') {
                    echo "<label><input type='checkbox' name='columns[]' value='$key'> $key</label><br>";
                }
            }
            ?>
            <input type="submit" value="Update Employee">
        </form>
        <?php
            } else {
                echo "<p>No employee found with given ID</p>";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['columns'])) {
            $empId = $_POST['empId']; $columns = $_POST['columns'];
            $setClause = "";
            foreach ($columns as $column) {
                if ($setClause != "") {
                    $setClause .= ", ";
                }
                $value = $_POST[$column];
                $setClause .= "$column='$value'";
            }
            $sql = "UPDATE empinfo SET $setClause WHERE empId=$empId";
            if ($conn->query($sql) === TRUE) {
                echo "Employee details updated successfully";
            } else {
                echo "Error updating employee details: " . $conn->error;
            }
        }
        ?>
    </div>
</body>
</html>
