<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Book Details</title>
    <h1> Reports </h1>
    <style>
        h1 {
            margin-top: 2px; text-align: center; color: #333; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 35px; }
        table { padding: 8px 8px; width: 100%;
            border-collapse: collapse; border-radius: 8px; overflow: hidden; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); }
        table, th, td {
            padding: 15px; border: 1px solid #ccc; }
        th {
            background-color:#21afdc; text-align: left;
            font-weight: bold; color: white; font-size: 17px;}
        td {
            text-align: middle; vertical-align: middle;}
        .search-container {
            margin-bottom: 20px; align-items: center;}
        .search-container input[type="text"], .filter-container select {
            padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        .search-container button, .filter-container button {
            padding: 10px 20px; background-color: #f01708;
            color: #fff; border: none;
            border-radius: 5px; cursor: pointer;
            transition: background-color 0.3s ease; }
        .search-container button:hover, .filter-container button:hover {
            background-color: #ff1a1a; font-size: 15px;}
        .filter-container {
            margin-bottom: 20px;}
        .search-container input[type="text"]:hover {
            box-shadow: 0 0 10px rgba(0, 0, 255, 0.3); 
        }
    </style>
</head>
<body>
<div class="search-container">
    <label for="destination">Search by Destination:</label>
    <input type="text" id="destination" name="destination" placeholder="Enter Destination" onkeyup="filterTable()">
    <button onclick="clearSearch()">Clear</button>
</div>
<div class="filter-container">
    <label for="status">Filter by Status:</label>
    <select id="status" onchange="filterTable()">
        <option value="">All</option>
        <option value="Booked">Booked</option>
        <option value="Cancelled">Cancelled</option>
        <option value="Claimed">Claimed</option>
        <option value="Expired">Expired</option>
    </select>
</div>
<table id="bookDetailsTable">
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Departure Date</th>
            <th>Validity</th>
            <th>Passenger Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'connection.php';
        $query = "SELECT * FROM bookdetails";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['bookingId'] . '</td>';
            echo '<td>' . $row['source'] . '</td>';
            echo '<td>' . $row['destination'] . '</td>';
            echo '<td>' . $row['bookDate'] . '</td>';
            echo '<td>' . $row['validity'] . '</td>';
            echo '<td>' . $row['passengerName'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
<script>
    function filterTable() {
        const inputDestination = document.getElementById('destination');
        const filterDestination = inputDestination.value.toUpperCase();
        const selectStatus = document.getElementById('status');
        const filterStatus = selectStatus.value.toUpperCase();
        const table = document.getElementById('bookDetailsTable');
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            const cellDestination = cells[2]; // Destination column
            const cellStatus = cells[6]; // Status column
            if ((cellDestination.textContent || cellDestination.innerText).toUpperCase().indexOf(filterDestination) > -1 || filterDestination === '') {
                if ((cellStatus.textContent || cellStatus.innerText).toUpperCase().indexOf(filterStatus) > -1 || filterStatus === '' || filterStatus === 'ALL') {
                    found = true;
                }
            }
            if (found) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
    function clearSearch() {
        document.getElementById('destination').value = '';
        document.getElementById('status').value = '';
        filterTable();
    }
</script>
</body>
</html>