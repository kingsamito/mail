<?php
$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "tester";

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword, $dbname) or die("Database connection failed");

if (isset($_POST['recipient_data']) && isset($_POST['recipient_data4']) && isset($_POST['recipient_data5'])) {
    $user = $_POST['recipient_data'];
    $user1 = $_POST['recipient_data4'];
    $user2 = $_POST['recipient_data5'];
    $sql = "SELECT * FROM info WHERE (receiver = '$user' or receiver = '$user1' or receiver = '$user2') and notified = ''";
    $res = mysqli_query($conn, $sql);

    $output = '';
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo $output = "<div id=" . $row['infoID'] . "><p>" . $row['sender'] . "</p>" . "<p>" . $row['subject'] . "</p></div>";
        }
    }
}

if (isset($_POST['recipient1_data'])) {
    $id = $_POST['recipient1_data'];
    $sql1 = "UPDATE `info` SET `notified`='yes' WHERE infoID = $id";
    $res1 = mysqli_query($conn, $sql1);
}
