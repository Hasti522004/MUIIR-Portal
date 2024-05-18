<a  href="../forms/copyright/copyright1.php"><button style="justify-content:right;" class="btn btn-primary">Add Inventor</button></a>
<?php
require_once "config.php";
$sql = "SELECT * FROM copyright1";
$res = $conn->query($sql);
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>id</th>
			<th>grno</th>
			<th>name</th>
			<th>address</th>
			<th>pincode</th>
			<th>nationality</th>
			<th>description</th>
			<th>title</th>
			<th>language_work</th>
			<th>publish</th>
			<th>remark</th>
			<th>Action</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if ($res->rowCount() > 0) {
			while ($row = $res->fetch()) {
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['grno']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['pincode']; ?></td>
					<td><?php echo $row['nationality']; ?></td>
					<td><?php echo $row['description']; ?></td>
					<td><?php echo $row['title']; ?></td>
					<td><?php echo $row['language_work']; ?></td>
					<td><?php echo $row['publish']; ?></td>
					<td><?php echo $row['remark']; ?></td>
					<td><a href="edit_copyright.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a></td>
					<td><a href="delete_copyright.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
				</tr>
		<?php
			}
		} else {
		?>
			<tr>
				<td colspan="12" class="text-center">No records found</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
