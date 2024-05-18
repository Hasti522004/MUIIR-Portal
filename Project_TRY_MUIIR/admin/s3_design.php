<a  href="../forms/design/design_form.php"><button style="justify-content:right;" class="btn btn-primary">Add Inventor</button></a>

<?php
require_once "config.php";
$sql = "SELECT * FROM design";
$res = $conn->query($sql);
?>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
            <th>ID</th>
			<th>Class No.</th>
			<th>GR No.</th>
			<th>Name</th>
			<th>Address</th>
			<th>Category of Applicant</th>
			<th>Educational Institution</th>
            <th>Title of Work</th>
            <th>Address For Service in India</th>
			<th>Description</th>
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
					<td><?php echo $row['classno']; ?></td>
					<td><?php echo $row['grno']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['catapp']; ?></td>
					<td><?php echo $row['eduins']; ?></td>
					<td><?php echo $row['twork']; ?></td>
					<td><?php echo $row['addind']; ?></td>
					<td><?php echo $row['description']; ?></td>
					<td><a href="edit_design.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a></td>
					<td><a href="delete_design.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>
				</tr>
		<?php
			}
		} else {
		?>
			<tr>
				<td colspan="14" class="text-center">No records found</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
