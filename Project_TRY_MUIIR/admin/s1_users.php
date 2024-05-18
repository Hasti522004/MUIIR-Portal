<a  href="../login/registration.php"><button style="justify-content:right;" class="btn btn-primary">Add User</button></a>
<a  href="assign_mentor.php"><button style="justify-content:right;" class="btn btn-primary">Assign Mentor</button></a>

<table border="1" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>grno</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>username</th>
                        <th>password</th>
                        <th>contactnumber</th>
                        <th>emailid</th>
                        <th>program</th>
                        <th>department</th>
                        <th>title</th>
                        <th>profilepic</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM users";
                    $res = $conn->query($sql);
                    if ($res->rowCount() > 0) {
                        while ($row = $res->fetch()) {
                    ?>
                            <tr>
                            <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['grno']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['contactnumber']; ?></td>
                                <td><?php echo $row['emailid']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['profilepic']; ?></td>
                                <td><a href="edit_user.php?grno=<?php echo $row['grno']; ?>">Edit</td>
                                <td><a href="delete_user.php?grno=<?php echo $row['grno']; ?>" onclick="return confirm('are you sure to delete it?')">Delete</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            <hr>
           