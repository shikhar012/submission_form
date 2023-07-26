<html>
    <head>
        <style>
           body{
            background-color: #d071f9;
           }
           table{
            background: white;
           }
        </style>
    </head>
</html>




<?php
//error_reporting(0);
$server="localhost:3307";
$username="root";
$password= ""; 
$db="us_trip";


$con = mysqli_connect($server,$username,$password,$db);
if(!$con)
{
    die("Connection to this databse failed due to".mysqli_connect_error()); // tell what type of error
}
//echo "succc";

$query= "select * from us_trip";
$data=mysqli_query($con,$query);
 
$total=mysqli_num_rows($data);

?>
<div>
    <h2 align="center"><mark>display all records</mark></h2>
</div>
<table border="1" cellspacing="7" width="80%">
    <tr>    
            <th width="5%">id</th>
            <th width="10%">name</th>
            <th width="5%">age</th>
            <th width="10%">gender</th>
            <th width="10%">email</th>
            <th width="10%">phone</th> 
            <th width="10%">operation</th> 
      
    </tr>
<?php
while($result=mysqli_fetch_assoc($data)) //converting into array
{
echo "<tr>    
            <td>".$result["id"]."</td>
            <td>".$result["name"]."</td>
            <td>".$result["age"]."</td>
            <td>".$result["gender"]."</td>
            <td>".$result["email"]."</td>
            <td>".$result["phone"]."</td>  
            <td><a href='http://localhost/coder/update_form.php?id=$result[id] & name=$result[name] & age=$result[age] & gender=$result[gender]& email=$result[email] & phone=$result[phone]'>update</a></td>

</tr>";

}

?>
</table>

