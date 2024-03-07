<html>
    <head>
        <title>Add Contact</title>
        <link rel="stylesheet" href="phoneBook.css">
    </head>
    <body>
        <div>
            <h1 class=horizontalCenter>Add Contact</h1>
            <div class=horizontalCenter><button onclick="window.location.href='index.html'">Home</button></div><br>
            <?php
                if(array_key_exists('name', $_POST) && array_key_exists('phone', $_POST) && array_key_exists('address', $_POST)){
                    if($_POST['name'] !== "" || $_POST['phone'] !== "" || $_POST['address'] !== ""){
                        $file = fopen("contacts.txt", "a");
                        fwrite($file, mb_convert_encoding(trim($_POST['name']),"UTF-8")."\n");
                        fwrite($file, mb_convert_encoding(trim($_POST['phone']),"UTF-8")."\n");
                        fwrite($file, mb_convert_encoding(trim($_POST['address']),"UTF-8")."\n");
                        fclose($file);
                        echo "<h2>Contact added</h2>";
                    }
                    else{
                        echo "<h2>Fill all the fields</h2>";
                    }
                }
            ?>
            <div class=horizontalCenter>
            <form action="add_contact.php" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="phone">Phone:</label><br>
                <input type="text" id="phone" name="phone"><br>
                <label for="address">Address:</label><br>
                <input type="text" id="address" name="address"><br><br>
                <div class=horizontalCenter>
                <input type="submit" value="Add">
                </div>
            </form>
            </div>
        </div>
    </body>
</html>