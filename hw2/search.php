<html>
    <head>
        <title>Search</title>
    </head>
    <body>
        <h1>Search</h1>
        <button onclick="window.location.href='index.html'">Home</button><br>
        <?php
            if($_POST['search'] == ""){
                echo "<h2>Enter a name to search</h2>";
                return;
            }
            $file = fopen("contacts.txt", "r",);
            $is_found = false;
            $search = mb_convert_encoding($_POST['search'],'UTF-8');
            while(!feof($file)){
                $name = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                $phone = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                $address = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                if(strcmp($name,$search)==0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Phone</th>";
                    echo "<th>Address</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$name."</td>";
                    echo "<td>".$phone."</td>";
                    echo "<td>".$address."</td>";
                    echo "</tr>";
                    echo "</table>";
                    $is_found = true;
                    break;
                }
            }
            fclose($file);
            if(!$is_found){
                echo "<h2>Contact not found</h2>";
            }
        ?>
    </body>

