<html>
    <head>
        <title>Employees</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php  
            $servername = "localhost";  //replace your servername
            $username = "root";   //replace your username
            $password = "";        //replace your password
            $dbname = "test";    //replace your database name
            $conn = new mysqli($servername, $username, $password, $dbname);
            //$conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . $conn->connect_error);
            }
            else{
                $query = "CREATE TABLE IF NOT EXISTS employees(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    _name VARCHAR(30) NOT NULL,
                    _date DATE NOT NULL,
                    checkin TIME NOT NULL,
                    checkout TIME NOT NULL,
                    work VARCHAR(30) NOT NULL
                )";
                
                try{
                    $conn->query($query);
                } catch (Exception $e) {
                    ;
                }
            }


            if(key_exists('listRecords',$_POST)){
                echo "<button onclick=window.location.href='index.php'>Back</button><br>";
                $sql = "SELECT * FROM employees";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<table><tr><th>Name</th><th>Date</th><th>Checkin</th><th>Checkout</th><th>Work Performed</th></tr>";
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row['_name']."</td><td>".$row['_date']."</td><td>".$row['checkin']."</td><td>".$row['checkout']."</td><td>".$row['work']."</td></tr>";
                    }
                }
                else{
                    echo "0 results";
                }
                exit();
            }
            else if(key_exists('submit',$_POST)){
                $name = $_POST['name'];
                $date = $_POST['date'];
                $checkin = $_POST['checkin'];
                $checkout = $_POST['checkout'];
                $work = $_POST['work'];
                $sql = "INSERT INTO employees (_name,_date,checkin,checkout,work) VALUES ('$name','$date','$checkin','$checkout','$work')";
                try{
                    $conn->query($sql);
                    echo "New record created successfully";
                } catch (Exception $e) {
                    echo $conn->error;
                }
            }
            else if(key_exists('searchByTime',$_POST)){
                echo "<button onclick=window.location.href='index.php'>Back</button><br>";
                $searchTime = $_POST['searchTime'];
                $sql = "SELECT * FROM employees WHERE checkin <= '$searchTime' AND checkout >= '$searchTime'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<table><tr><th>Name</th><th>Date</th><th>Checkin</th><th>Checkout</th><th>Work Performed</th></tr>";
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row['_name']."</td><td>".$row['_date']."</td><td>".$row['checkin']."</td><td>".$row['checkout']."</td><td>".$row['work']."</td></tr>";
                    }
                }
                else{
                    echo "0 results";
                }
                exit();
            }
            else if(key_exists('searchByName',$_POST)){
                echo "<button onclick=window.location.href='index.php'>Back</button><br>";
                $search = $_POST['search'];
                $sql = "SELECT * FROM employees WHERE _name = '$search'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<table><tr><th>Name</th><th>Date</th><th>Checkin</th><th>Checkout</th><th>Work Performed</th></tr>";
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row['_name']."</td><td>".$row['_date']."</td><td>".$row['checkin']."</td><td>".$row['checkout']."</td><td>".$row['work']."</td></tr>";
                    }
                }
                else{
                    echo "0 results";
                }
                exit();
            }
            $conn->close();
            ?>
        <form action="index.php" method="post">
            <button type="submit" name="listRecords" value="True">List Records</button>
        </form>
        <h3>Add Employee Record</h3>
        <form action='index.php' method='post'>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date"><br>
            <label for="checkin">Checkin:</label>
            <input type="time" id="checkin" name="checkin"><br>
            <label for="checkout">Checkout:</label>
            <input type="time" id="checkout" name="checkout"><br>
            <label for="work">Work Performed:</label>
            <input type="text" id="work" name="work"><br>
            <button type="submit" name="submit" value="True">Submit</button>
        </form>
        <h3>Employees Search by Name</h3>
        <form action='index.php' method='post'>
            <input type='text' id='search' name='search' placeholder='Employee Name'><br>
            <button type="submit" name="searchByName" value="True">Search</button>
        </form>
        <h3>Employees Search by Time</h3>
        <form action='index.php' method='post'>
            <input type='time' id='searchTime' name='searchTime'><br>
            <button type="submit" name="searchByTime" value="True">Search</button>
    </body>

</html>