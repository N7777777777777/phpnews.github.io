<?php
date_default_timezone_set("Asia/Bangkok");
$cn = new mysqli("localhost", "root", "", "php23");
$cn->set_charset("utf8");

$sql = "SELECT * FROM tbl_news ORDER BY id DESC";
$res = $cn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td>
                <img src="img/<?php echo $row[3]; ?>" alt="">
            </td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            <td><?php echo $row[7]; ?></td>
            <td><?php echo strtotime($row[8]); ?></td>
            <td><?php echo $row[9]; ?></td>
            <td><?php echo $row[10]; ?></td>
            <td><?php echo $row[11]; ?></td>


        </tr>
        <?php
}
}
?>