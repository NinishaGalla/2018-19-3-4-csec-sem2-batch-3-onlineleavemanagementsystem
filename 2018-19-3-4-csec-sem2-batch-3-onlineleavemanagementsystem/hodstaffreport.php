<?php
require('db.php');
session_start();
?>
<html>
<head>
<title>Staff Leave Report</title>
<style>
body{}
ul#navmenu,ul.sub1 {
       list-style-type: none;
       font-size: 9pt;
       position: absolute;
       z-index: 11;
  }
 
 ul#navmenu li{
    
    width: 130px;
    text-align: center;
    position: relative;
    float: left;
    margin-right: 4px;
    
 }
ul#navmenu{background-color:grey;width:100%;}

 ul#navmenu a{
    text-decoration: none;
    display: block;
    width:130px;
    height: 25px;
    line-height: 25px;
    background-color: #FFF;
    border: 1px solid #CCC;
    border-radius: 5px;
}
 ul#navmenu .sub1 a {
         margin-top: 5px;
    }
ul#navmenu ul.sub1 {
         display: none;
         position: absolute;
         top: 26px;
         left: 0px;
  }

 
 ul#navmenu li:hover > a {
         background-color: #CFC;
 }
 ul#navmenu li:hover a:hover {
         background-color: #FF0;
   }
 
 ul#navmenu li:hover .sub1 {
        display: block;
      }

table {
  font-family: arial, sans-serif;
  padding:15px;
  width: 100%;
border-spacing:5px;
  

}

th {
background-color:pink;
  border: 1px solid brown;
  text-align: left;
  padding: 8px;
}

td {
  border: 1px solid blue;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.dropdown {
    position: relative;

    color:blue;
    
}

.dropdown-content {
    display: none;
    position: absolute;
    right:-350px;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    color:black;
}

.dropdown:hover .dropdown-content {
    display: block;
}

</style>
</head>
<body>

<ul id="navmenu">
  <li><a href="hodprofile.php">View Profile</a>
      
     </li>
     <li><a href="#">View Requests</a>
          <ul class="sub1">
             <li><a href="hodfacultyrequest.php">Faculty</a>
                 
             </li>
             <li><a href="hodstaffrequest.php">Staff</a>
                 
             </li>
             
         </ul>
     </li>

    <li><a href="hodviewcancelleaves.php">View Cancel Leaves</a>
          
     </li>

    <li><a href="#">View Details</a>
          <ul class="sub1">
             <li><a href="hodfacultyreport.php">Faculty</a>
                 
             </li>
             <li><a href="hodstaffreport.php">Staff</a>
                 
             </li>
             
         </ul>
     </li>

    <li><a href="logout.php">Log Out</a></li>
    
</ul>


<br><br><br>

<h1>Staff Leave Reports</h1>
<br>
<form method="post">
Enter Staff ID:
<input type="text" name="id">
<br><br>
<button type="submit" name="submit" style="background-color: blue;height: 5%;color: white;border-radius: 5px;width: 5%;">Submit</button>
<button type="submit" name="balance">Get Balance</button>
</form>

<?php
    if(isset($_REQUEST['submit'])){ ?>
<table>
  <thead>
  <tr>
    
     <th  rowspan="2">Apply Date</th>
    <th  rowspan="2">ID</th>
    <th  rowspan="2">Name</th>
    <th  rowspan="2">Leave Type</th>
    <th rowspan="2">Purpose</th>    
    <th  rowspan="2">Status</th>
  </tr>
 </thead>
 <tbody>
    
 <?php
 $i=1;
$d=$_POST['id'];
$dept=$_SESSION['department'];
 $sql="SELECT * FROM staffleave where department='$dept' and id='$d'";
$result=mysqli_query($con, $sql);

$count=mysqli_num_rows($result);

if($count>0){
  while ($row=mysqli_fetch_array($result)) {
    
  

    ?>
    <tr>

      <td><?php echo $row['applydate']; ?></td>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['leavetype']; ?></td>
      <td><?php echo $row['purpose']; ?></td>
      <td style="color: green;"><?php echo $row['status']; ?></td>
    </tr>
    <?php $i++;}}else{echo "No Record Found!";} 
  }  ?>
 </tbody>
</table>
<?php
if(isset($_REQUEST['balance'])){ 
  ?>
     CasualLeave: <?php echo $row['CasualLeave']; ?><br>
     EarnedLeave: <?php echo $row['EarnedLeave']; ?><br>
     SickLeave: <?php echo $row['SickLeave']; ?><br>
     NonVacationLeave: <?php echo $row['NonVacationLeave']; ?><br>
     OneHourPermission: <?php echo $row['OneHourPermission']; ?><br>
     ExtraLeave: <?php echo $row['extraleave']; ?><br>

<?php } ?>

</body>
</html>