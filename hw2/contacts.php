<html>
    <head>
        <title>Contacts</title>
        <link rel="stylesheet" href="phoneBook.css">
    </head>
    <body>
        <div>
            <h1 class=horizontalCenter>Contacts</h1>
            <div class=horizontalCenter><button onclick="window.location.href='index.html'">Home</button></div><br>
            <table class=horizontalCenter>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
                <?php
                    function printContacts($contacts){
                        foreach($contacts as $contact){
                            echo "<tr>";
                            echo "<td>".$contact['name']."</td>";
                            echo "<td>".$contact['phone']."</td>";
                            echo "<td>".$contact['address']."</td>";
                            echo "</tr>";
                        }
                    }
                    function readContacts(){
                        $file = fopen("contacts.txt", "r");
                        $contacts = [];
                        while(!feof($file)){
                            $name = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                            $phone = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                            $address = mb_convert_encoding(trim(fgets($file)),"UTF-8");
                            if($name != ""){
                                $contact = ['name' => $name, 'phone' => $phone, 'address' => $address];
                                array_push($contacts, $contact);
                            }
                        }
                        fclose($file);
                        return $contacts;
                    }
                    $contacts = readContacts();
                    printContacts($contacts);
                ?>
            </table>
        </div>    
    </body>
</html>
