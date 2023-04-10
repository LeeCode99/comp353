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
     
        $eid = $_POST["EID"];
        $startd = $_POST["startdate"];
        $endd = $_POST["enddate"];
        $fid = $_POST["fid"];

        if ($_POST['Actions'] == "Create") {
            $SQLActions = "INSERT INTO Work_at (EmployeeID, StartDate, EndDate, Facility_ID) 
                 VALUES (" . $eid . ",'" . $startd . "','" . $endd . "'," . $fid . "); ";
        }
        if ($_POST['Actions'] == "Edit") {
            $SQLActions = "UPDATE Work_at SET StartDate= '" . $startd . "00:00:00.000', EndDate= '" . $endd . "00:00:00.000', Facility_ID = " . $fid . " Where EmployeeID = " . $eid . ";";
        }
        if ($_POST['Actions'] == "Delete") {
            $SQLActions = "Delete from Work_at where EmployeeID = " . $eid . ";";
        }
        if ($conn->query($SQLActions) === true) {
            header("Location: Schedule.php");
            exit();
        } else {
            echo "Error: " . $SQLActions . "<br>" . $conn->error;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == 'GET') {
        if ($_GET["Actions"] == "Assign") {
            $sql = "select EmployeeID from Employees order by EmployeeID DESC;";
        }
        if ($_GET["Actions"] == "Edit") {
            $sql = "select EmployeeID,
            StartDate,
            EndDate,
            Facility_ID
            from Work_at where EmployeeID =" . $_GET['EID'] . ";";
        }
        if ($_GET["Actions"] == "Delete") {
            $sql = "select EmployeeID,
            StartDate,
            EndDate,
            Facility_ID
            from Work_at where EmployeeID =" . $_GET['EID'] . ";";
        }
    }


    $result = $conn->query($sql);
    $row = $result->fetch_row();
    ?>
    <h1>Health Facility Employee Status Tracking System</h1>
    <?php include "menu.php" ?>

    <h2>Assign schedule to an Employee</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>

                <th>Employee ID: </th>

                <th>

                    <select name="eid">
                        <?php
                        if ($_GET['Actions'] == "Assign") {
                            $sql1 = "select distinct EmployeeID from Work_at order by EmployeeID;";
                            $result = $conn->query($sql1);
                            while ($row = $result->fetch_row()) {
                                echo "<option value=" . $row[0] . ">" . $row[0] . "</option>";
                            }
                        } else
                            echo "<option value=" . $row[0] . ">" . $row[0] . "</option>";
                        ?>
                </th>
            </tr>
            <tr>
                <th>Start Date: </th>
                <th><input type="date" name="startdate" value="<?php if ($_GET['Actions'] != "Assign") echo $row[1] ?>"></th>
            </tr>
            <tr>
                <th>End Date: </th>
                <th><input type="date" name="enddate" value="<?php if ($_GET['Actions'] != "Assign") echo $row[2] ?>"></th>
            </tr>
            <tr>
                <th>Facility_ID: </th>
                <th><input type="number" name="fid" value="<?php if ($_GET['Actions'] != "Assign") echo $row[3] ?>"></th>
            </tr>

            <tr>
                <th><input type="submit" name="Actions" value="<?php
                                                                if ($_GET["Actions"] == "Assign") echo "Assign";
                                                                if ($_GET["Actions"] == "Delete") echo "Delete";
                                                                if ($_GET["Actions"] == "Edit") echo "Edit";
                                                                ?>"></th>
                <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
            </tr>
        </table>
    </form>
</body>

</html>