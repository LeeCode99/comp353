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

    $sql = "select 
        EmployeeID,
        StartDate,
        EndDate,
        Facility_ID
     from Work_at order by EmployeeID, Facility_ID";

     
    $result = $conn->query($sql);


    echo "<form method='GET' action='CUEDSchedule.php?'>";
    echo "<input type='submit' name='Actions' value='Assign'>";
    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
    <tr>
    <th>EmployeeID</th>
    <th>StartDate</th>
    <th>EndDate</th>
    <th>Facility_ID</th>
    <th>Actions</th>
</tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            
            echo "<th>" . $row["EmployeeID"] . "</th>";
            echo "<th>" . $row["StartDate"] . "</th>";

            if ($row["EndDate"] == null) {
                echo "<th>Present</th>";
            } else {
                echo "<th>" . $row["EndDate"] . "</th>";
            }
            echo "<th>" . $row["Facility_ID"] . "</th>";

            echo "<th><a href=CUEDSchedule.php?EID=" . $row["EmployeeID"] . "&Actions=Edit>Edit
                <a href=CUEDSchedule.php?EID=" . $row["EmployeeID"] . "&Actions=Delete>Delete
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