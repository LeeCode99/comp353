<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>
    <h2>Employee Information</h2>
    <?php
    $servername = "qac353.encs.concordia.ca";
    $username = "qac353_4";
    $password = "ptkg7903";
    $dbname = "qac353_4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select EmployeeID,
            Email_Address,
            Citizenship,
            Postal_code,
            Province,
            City,
            Address,
            Telephone,
            DoB,
            First_name,
            Last_name,
            Medicare_Card_Number
     from Employees";
    $result = $conn->query($sql);


    echo "<form method='GET' action='CUEDEmployee.php?'>";
    echo "<input type='submit' name='Actions' value='Create'>";
    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
    <tr>
    <th>EmployeeID</th>
    <th>Email_Address</th>
    <th>Citizenship</th>
    <th>Postal_code</th>
    <th>Province</th>
    <th>City</th>
    <th>Address</th>
    <th>DoB</th>
    <th>First_name</th>
    <th>Last_name</th>
    <th>Medicare_Card_Number</th>
    <th>Actions</th>
</tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row["EmployeeID"] . "</th>";
            echo "<th>" . $row["Email_Address"] . "</th>";
            echo "<th>" . $row["Citizenship"] . "</th>";
            echo "<th>" . $row["Postal_code"] . "</th>";
            echo "<th>" . $row["Province"] . "</th>";
            echo "<th>" . $row["City"] . "</th>";
            echo "<th>" . $row["Address"] . "</th>";
            echo "<th>" . $row["DoB"] . "</th>";
            echo "<th>" . $row["First_name"] . "</th>";
            echo "<th>" . $row["Last_name"] . "</th>";
            echo "<th>" . $row["Medicare_Card_Number"] . "</th>";
            echo "<th><a href=CUEDEmployee.php?EID=" . $row["EmployeeID"] . "&Actions=Edit>Edit
                <a href=CUEDEmployee.php?EID=" . $row["EmployeeID"] . "&Actions=Delete>Delete
                </th>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    echo "</form>";
    $conn->close();
    ?>
</BODY>

</HTML>