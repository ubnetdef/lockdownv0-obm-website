<?php
require '../includes/admin_nav.php';

$title = 'Personnel Management | Office of Blue Team Management';
$curnav = 'Personnel Management';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();
requireAdmin();

include '../includes/header.php';
?>

<section id="people" class="container">
    <div class="center">
        <h2>Personnel Management</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>

    <hr>

    <table class="table table-striped">
    	<thead>
    		<tr>
    			<td>User ID</td>
    			<td>Username</td>
    			<td>Admin?</td>
    			<td>Actions</td>
    		</tr>
    	</thead>

    	<tbody>
    	<?php
    		$stmt = $db->prepare('SELECT * FROM users WHERE password != "disabled"');
    		$stmt->execute();

    		while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
    			echo '<tr>';

    			echo '<td>'.$row['id'].'</td>';
    			echo '<td>'.$row['username'].'</td>';
    			echo '<td>'.($row['admin'] == 1 ? 'Yes' : 'No').'</td>';
    			echo '<td><a href="/admin/edit.php?id='.$row['id'].'" class="btn btn-xs btn-primary">EDIT</a> <a href="/admin/delete.php?id='.$row['id'].'" class="btn btn-xs btn-danger">DELETE</a></td>';

    			echo '</tr>';
    		}
    	?>

    	<tr>
    		<td colspan="4">
    			<a href="/admin/create.php" class="btn btn-md btn-primary pull-right">Create User</a>
    		</td>
    	</tr>
    	</tbody>
    </table>
</section>

<?php include '../includes/footer.php'; ?>