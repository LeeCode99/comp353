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
if ($_SERVER["REQUEST_METHOD"]=='POST'){
    $fid = $_POST["FAID"];
    $fname = $_POST["name"];
    $faddress = $_POST["address"];
    $city = $_POST["city"];
    $fprovince = $_POST["province"];
    $fpostalcode = $_POST["postalCode"];
    $fphone = $_POST["PhoneNumber"];
    $fwebsite = $_POST["WebAddress"];
    $ftype = $_POST["Type"];
    $fcapcity = $_POST["Capacity"];

    if ($_POST['Actions']=="Create"){
        $SQLActions = "INSERT INTO Facilities (Facility_ID, Name, Address, City, Province, Postal_code, Telephone, WebAddress, Type, Capacity) 
                 VALUES (".$fid.",'$fname','$faddress','$city','$fprovince','$fpostalcode','$fphone','$fwebsite','$ftype',".$fcapcity."); ";
    }
    if ($_POST['Actions']=="Edit"){
        $SQLActions = "UPDATE Facilities SET Name='".$fname."', Address='".$faddress."', City='".$city."', Type='".$ftype."', Province='".$fprovince."', WebAddress='".$fwebsite."', Postal_code='".$fpostalcode."', Telephone='".$fphone."', Capacity= ".$fcapcity." Where Facility_ID = ".$fid .";";
    }
    if ($_POST['Actions']=="Delete"){
        $SQLActions = "Delete from Facilities where Facility_ID = ".$_GET['FAID'].";";
    }
    if ($conn -> query($SQLActions)===true){
        header("Location: Facility.php");
        exit();
    }else{
        echo "Error: ".$SQLActions . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"]=='GET'){
    if ($_GET["Actions"]=="Create"){
        $sql = "select Facility_ID from Facilities order by Facility_ID DESC;";
    }
    if ($_GET["Actions"]=="Edit"){
        $sql = "select Facility_ID, Name, Address, City, Province, Postal_code, Telephone, WebAddress, Type, Capacity from Facilities where Facility_ID =".$_GET['FID'].";";
    }
    if ($_GET["Actions"]=="Delete"){
        $sql = "select Facility_ID, Name, Address, City, Province, Postal_code, Telephone, WebAddress, Type, Capacity from Facilities where Facility_ID =".$_GET['FID'].";";
    }
}


$result = $conn->query($sql);
$row = $result->fetch_row();
?>
    <h1>Health Facility Employee Status Tracking System</h1>
<?php include "menu.php"?>
    <h2>Create Facility</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table>
            <tr>
                <th>Facility ID: </th>
                <th><input type="text" name="FAID" value=<?php if($_GET['Actions']=="Create")
                    echo $row[0]+1;
                    else echo $row[0];
                ?>></th>
            </tr>
            <tr>
                <th>Facility Name: </th>
                <th><input type="text" name="name" value="<?php if ($_GET['Actions']!="Create") echo $row[1]?>"></th>
            </tr>
            <tr>
                <th>Address: </th>
                <th><input type="text" name="address" value="<?php if ($_GET['Actions']!="Create") echo $row[2]?>"></th>
            </tr>
            <tr>
                <th>City: </th>
                <th><input type="text" name="city" value="<?php if ($_GET['Actions']!="Create") echo $row[3]?>"></th>
            </tr>
            <tr>
                <th>Province: </th>
                <th><input type="text" name="province" value="<?php if ($_GET['Actions']!="Create") echo $row[4]?>"></th>
            </tr>
            <tr>
                <th>Postal Code: </th>
                <th><input type="text" name="postalCode" value="<?php if ($_GET['Actions']!="Create") echo $row[5]?>"></th>
            </tr>
            <tr>
                <th>Phone Number: </th>
                <th><input type="text" name="PhoneNumber" value="<?php if ($_GET['Actions']!="Create") echo $row[6]?>"></th>
            </tr>
            <tr>
                <th>Web Address: </th>
                <th><input type="text" name="WebAddress" value="<?php if ($_GET['Actions']!="Create") echo $row[7]?>"></th>
            </tr>
            <tr>
                <th>Type: </th>
                <th><input type="text" name="Type" value="<?php if ($_GET['Actions']!="Create") echo $row[8]?>"></th>
            </tr>
            <tr>
                <th>Capacity: </th>
                <th><input type="text" name="Capacity" value="<?php if ($_GET['Actions']!="Create") echo $row[9]?>"></th>
            </tr>
            <tr>
                <th><input type="submit" name="Actions" value="<?php
                   if ($_GET["Actions"]=="Create") echo "Create";
                   if ($_GET["Actions"]=="Delete") echo "Delete";
                   if ($_GET["Actions"]=="Edit") echo "Edit";
                   ?>"></th>
                <th><input type="button" name="back" value="Go back" onclick="history.back()"></th>
            </tr>
        </table>
    </form>
</body>
</html>