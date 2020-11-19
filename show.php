<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>ITF Lab</title>
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
<table width="600" border="1">
  <tr>
    <th width="100"> <div align="center">Name</div></th>
    <th width="350"> <div align="center">Comment </div></th>
    <th width="150"> <div align="center">Action </div></th>
  </tr>
<?php
while($Result = mysqli_fetch_array($res))
{
?>
  <tr>
    <td><?php echo $Result['Name'];?></div></td>
    <td><?php echo $Result['Comment'];?></td>
    <td align="center"><button class="btn btn-primary"
        onclick='Edit(<?php echo json_encode(["id" => $Result["ID"], "name" => $Result["Name"], "comment" => $Result["Comment"], "link" => $Result["Link"]]); ?>)'>Edit</button>
      <button class="btn btn-danger" onclick="Delete(<?php echo $Result['ID']; ?>)">Delete</button>
    </td>
  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
<script>
function toggleButton(e) {
    e.attr("disabled") ? e.removeAttr("disabled") : e.attr("disabled", !0)
}

function Edit({name, comment, link}) {
    Swal.fire({
        title: 'Multiple inputs',
        html: '<input id="swal-input1" class="swal2-input" value="'+name+'">' +
            '<input id="swal-input2" class="swal2-input" value="'+comment+'">' +
            '<input id="swal-input3" class="swal2-input" value="'+link+'">',
        focusConfirm: true,
        allowOutsideClick: false,
        preConfirm: () => {
            return [
                document.getElementById('swal-input1').value,
                document.getElementById('swal-input2').value,
                document.getElementById('swal-input3').value
            ]
        }
    });
}

function Delete(id) {
    console.log(id)
    $.ajax({
        url: "delete.php",
        method: 'post',
        data: {
            id: id
        },
        dataType: "json"
    }).done(({
        code
    }) => {
        if (code == 200) {
            $("#" + id).remove();
        }
    });
}
$(document).ready(function() {
    $('#table_id').DataTable();
    $('#insert').submit((e) => {
        e.preventDefault();
        var t = $(e.currentTarget),
            n = t.find("button");
        toggleButton(n);
        $.ajax({
            url: "insert.php",
            method: 'post',
            data: t.serializeArray(),
            dataType: "json"
        }).done(({
            code
        }) => {
            if (code == 200) {
                location.reload();
            }
        }).then(() => {
            toggleButton(n);
        });
    })
});
</script>
</html>
