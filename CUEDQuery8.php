<!-- Purpose: To display the details of the employee selected from the drop down menu -->
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


    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if ($_POST["Actions"] == "Details") {

            $sql = "Select name,
                StartDate,
                EndDate
                from Employees, Facilities
                JOIN Work_at on Work_at.Facility_ID = Facilities.Facility_ID
                where Employees.EmployeeID = Work_at.EmployeeID AND Employees.EmployeeID = " . $_POST["select1"] . "
                order by name, StartDate;";
        }
    }

    $result = $conn->query($sql);
    
    echo "<h1> Health Facility Employee Status Tracking System</h1>";
    include "menu.php"; 
    echo "<h2>Details of Employee ID: " . $_POST["select1"] . " </h2>";
    
    echo "
    <table>
        <tr>
            <th>Facility Name:</th>
            <th>Current Date:</th>
            <th>Start Date:</th>
            <th>End Date:</th>
        </tr>";
    echo "<tr>";
    while ($row = $result->fetch_row()) {
        echo "<th>" . $row[0] . "</th>";
        echo "<th>" . date("Y-m-d") . "</th>";
        echo "<th>" . $row[1] . "</th>";
        if ($row[2] == NULL) {
            echo "<th>" . "Present" . "</th>";
        } else {
            echo "<th>" . $row[2] . "</th>";
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
    <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
</body>

</html>