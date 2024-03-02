<html>
    <head>
        <title>Add Contact</title>
    </head>
    <body>
        <h1>Add Contact</h1>
        <button onclick="window.location.href='index.html'">Home</button><br>
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
        <form action="add_contact.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone"><br>
            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address"><br><br>
            <input type="submit" value="Add">
        </form>
        
    </body>
</html>