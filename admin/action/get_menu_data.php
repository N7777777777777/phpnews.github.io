<?php
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");

$sql = "SELECT * FROM tbl_menu ORDER BY id DESC";
$res = $cn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {

        ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td>
                <img src="img/<?php echo $row[2]; ?>" alt="">
            </td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>

        </tr>
        <?php
}
}
?>