<a  href="add_affiliation.php"><button style="justify-content:right;" class="btn btn-primary">Add Affiliation</button></a>

<?php require_once "add_affiliation.php"; ?>
            <table border="1" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image URL</th>
                        <th>Caption</th>
                        <th>Date and Time</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM affiliation_detail";
                    $res = $conn->query($sql);
                    if ($res->rowCount() > 0) {
                        while ($row = $res->fetch()) {
                    ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['image_url']; ?></td>
                                <td><?php echo $row['caption']; ?></td>
                                <td><?php echo $row['date_time']; ?></td>
                                <td><a href="delete_affiliation.php?id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure to delete it?')">Delete</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>