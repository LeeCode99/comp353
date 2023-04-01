<!-- For a given employee, get the details of all the schedules 
     she/he has been scheduled during a specific period of time. 
     Details include facility name, day of the year, start time and end time. 
     Results should be displayed sorted in ascending order by facility name, 
     then by day of the year, the by start time. -->

<html>

<head>
    <TITLE>Health Facility Employee Status Tracking System</TITLE>
</head>

<body>
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

    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
        if ($_GET["Actions"] == "Details") {
            $sql = "Select name,
                StartDate,
                EndDate
                from Employees, Facilities
                INNER JOIN Work_at on Work_at.Facility_ID = Facilities.Facility_ID
                where Employees.EmployeeID = Work_at.EmployeeID AND Employees.EmployeeID = 23
                order by name, StartDate;";
        }
    }

    $result = $conn->query($sql);
    $row = $result->fetch_row();

    ?>

    <h1> Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>



    <h2>Details of Employee</h2>
    <?php
    echo "
    <table>
        <tr>
            <th>Facility Name:</th>
            <th>Current Date:</th>
            <th>Start Date:</th>
            <th>End Date:</th>
        </tr>";


    echo "<tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<th>" . $row["name"] . "</th>";
        echo "<th>" . date("Y-m-d") . "</th>";
        echo "<th>" . $row["StartDate"] . "</th>";
        if ($row["EndDate"] == NULL) {
            echo "<th>" . "Present" . "</th>";
        } else {
            echo "<th>" . $row["EndDate"] . "</th>";
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
    <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
</body>

</html>