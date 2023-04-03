<!-- For a given employee, get the details of all the schedules 
     she/he has been scheduled during a specific period of time. 
     Details include facility name, day of the year, start time and end time. 
     Results should be displayed sorted in ascending order by facility name, 
     then by day of the year, the by start time. -->

<HTML>

<HEAD>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</HEAD>

<BODY>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>
    <h2>Facilities Information</h2>
    <?php
    $servername = "qac353.encs.concordia.ca";
    $username = "qac353_4";
    $password = "ptkg7903";
    $dbname = "qac353_4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql1 = "select distinct EmployeeID from Work_at order by EmployeeID;";

    $result = $conn->query($sql1);

    echo "<form method='POST' action='CUEDQuery8.php?' >";
    echo "<input type='submit' name='Actions' value='Details'/>";

    if ($result->num_rows > 0) {
        echo "<table border='1 solid black'> 
        <tr>
        <th>Employee ID: </th>
        </tr>";

        echo "<tr>
         <th>

        <select name='select1'>";

        $result = $conn->query($sql1);
        while ($row = $result->fetch_row()) {
            echo "<option name='eid' value=" . $row[0] . ">" . $row[0] . "</option>";
        }
    } else {
        echo "0 results";
    }
    
    echo "</th></select></tr></form>";
    $conn->close();
    ?>
</BODY>

</HTML>