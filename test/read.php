<?php

$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "tester";

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword, $dbname) or die("Database connection failed");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Final Year Project/Memo/jquery.min.js"></script>
</head>

<body>
    
    <input id="user" type="hidden" value="james">
    <div id="message">

    </div>
</body>

<script>
    function findnotification() {
        var user = document.getElementById("user");
        console.log(user.value)
        var value = user.value
        var value1 = "jame"
        var value2 = "john"

        $.ajax({
            url: 'getnoti.php',
            type: "POST",
            data: {
                recipient_data: value,
                recipient_data4: value1,
                recipient_data5: value2
            },
            success: function(data) {
                $('#message').html(data);
               /*  
                // console.log(data);
                const parent = document.getElementById("message");
                const children = Array.from(parent.children);
                const ids = children.map(element => {
                    return element.id;
                })
                console.log(ids);
                console.log(ids.length);
                console.log(parent);
                console.log(children);
                run(ids); */
            }
        })
    }

    setInterval('findnotification()',1000);
</script>

<script>
    function run(ids) {
        const len = ids.length;
        console.log('len ' + len)
        for (let i = 0; i < len; i++) {
            let content = document.getElementById(ids[i]);
            let first = content.firstChild;
            let last = content.lastChild;
            console.log(first, last);
            if (Notification.permission === "granted") {
                showNotification(ids[i], first, last);
            } else if (Notification.permission !== "denied") {
                Notification.requestPermission().then(permission => {
                    if (permission === "granted") {
                        showNotification(first, last);
                    }
                })
            }
        }
    }
</script>
<script>
    function showNotification(i, first, last) {

        var title = "New message from " + first.textContent;
        var body = last.textContent;
        const notification = new Notification(
            title, {
                body: body
            },
        );


        $.ajax({
            url: 'getnoti.php',
            type: "POST",
            data: {
                recipient1_data: i
            },
            success: function(data) {

                console.log("done")
            }
        })

    }
</script>

</html>