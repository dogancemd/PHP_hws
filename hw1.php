<?php session_start();
session_start();

$days = array(
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday"
);
$clocks = array(
    "9:00",
    "10:00",
    "11:00",
    "12:00"
);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $times  = ($_SESSION['my_times']);
    $people = ($_SESSION['my_people']);
}
else{
    $times = array(
    );
    foreach($clocks as $time){
        $times[$time] = array(
        );
        foreach($days as $day){
            $times[$time][$day] = "Free";
        }
    }
    $people = array(
    );
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $day = $_POST['day'];
    $time = $_POST['time']; 
    if($_POST['submit'] == "OK"){
        if(array_key_exists($name, $people)&&$people[$name]>2){
            echo "You already have 3 reservation";
        }
        else if($times[$time][$day] != "Free"){
            echo "This time is already reserved";
        }
        else{
            if(array_key_exists($name, $people))
                $people[$name] = $people[$name] + 1;
            else{
                $people[$name] = 1;
            }
            $times[$time][$day] = $name;
        }
        
    }
    if($_POST['submit'] == "Del"){
        if($times[$time][$day] == $name){
            $times[$time][$day] = "Free";
            $people[$name]--;
        }
        else{
            echo "You don't have a reservation";
        }
    }
}
$_SESSION['my_times']  = $times;
$_SESSION['my_people'] = $people;
echo "</html>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>Fitness Reservation</h1>
"."
<table>
<tr>
    <th>Time</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Sunday</th>
";
foreach($times as $key => $value){
    echo "<tr><td>".$key."</td>";
    foreach($days as $day){
        echo "<td>".$value[$day]."</td>";
    }
    echo "</tr>";
}
echo "</table>";    
echo "<form action=\"hw1.php\" method=post>
    <label for=\"name\">Guest Name:</label><br>
    <input name=\"name\" id=\"name\" placeholder=\"Your Name\"><br>
    <label for=\"days\">Your Day:</label><br>
    <select name=\"day\" id=\"days\"><br>
        <option value=\"Monday\">Monday</option>
        <option value=\"Tuesday\">Tuesday</option>
        <option value=\"Wednesday\">Wednesday</option>
        <option value=\"Thursday\">Thursday</option>
        <option value=\"Friday\">Friday</option>
        <option value=\"Saturday\">Saturday</option>
        <option value=\"Sunday\">Sunday</option>
    </select>
    <select name=\"time\" id=\"time\">
        <option value=\"9:00\">9:00</option>
        <option value=\"10:00\">10:00</option>
        <option value=\"11:00\">11:00</option>
        <option value=\"12:00\">12:00</option>
    </select><br>
        <input type=\"submit\" name=\"submit\" value=\"OK\">
        <input type=\"submit\" name=\"submit\" value=\"Del\">
</form>";





echo "</body> </html>"




?>