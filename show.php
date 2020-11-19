<html>
<head>
    <title>ITF Lab06</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--css-->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
    <body>
<?php
$conn = mysqli_init();
mysqli_real_connect($conn, 'sqlthanee.mysql.database.azure.com', 'thanee@sqlthanee', 'Yongyong00', 'itflab', 3306);
if (mysqli_connect_errno($conn))
{
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}
$res = mysqli_query($conn, 'SELECT * FROM guestbook');
?>
<br>
<div class="container" bg-white mx-auto rounded-lg shadow mt-3 p-4 mb-3">
    <table class = "table table-bordered table-hover" width="1200" align="center" border="1">
        <thead class="thead-dark">
    <tr>
        <th width="300"> <div align="center">Name</div></th>
        <th width="300"> <div align="center">Comment </div></th>
        <th width="300"> <div align="center">Link </div></th>
        <th width="300"> <div align="center">ID</div></th>
    </tr>
    </thead>
<?php
while($Result = mysqli_fetch_array($res))
{
?>
        <tbody>
                <tr>
            <td><?php echo $Result['Name'];?></td>
            <td><?php echo $Result['Comment'];?></td>
            <td><?php echo $Result['Link'];?></td>
            <td>
                <a href="edit.php?ID=<?php echo $Result['ID']?>" class="btn btn-outline-success" >EDIT</a>
                <a href="del.php?ID=<?php echo $Result['ID']?>" class="btn btn-outline-danger"onclick="return confirm('Confirm data deletion?')">DELETE</a>
                </tr>
        </tbody>
<?php
}
?>
    </table>
    <button type="button" class="btn btn-outline-warning" onclick ="window.location.href='form.html'">ADD</button> 
<?php
mysqli_close($conn);
?>
    </body>
</html>
