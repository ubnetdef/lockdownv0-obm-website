<?php
require '../includes/admin_nav.php';

$title = 'File Editor | Office of Blue Team Management';
$curnav = 'File Editor';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();
requireAdmin();

if ( isset($_POST['contents']) && isset($_POST['filename']) ) {
	$fh = fopen($_POST['filename'], 'w');

	if ( $fh !== false ) {
		fwrite($fh, $_POST['contents']);
		fclose($fh);

		$message = '<div class="alert alert-success">Updated file "'.$_POST['filename'].'"!</div>';
	} else {
		$message = '<div class="alert alert-danger">Unable to open file "'.$_POST['filename'].'" for writing.</div>';
	}
} else {
	$message = '';

	if ( isset($_GET['f']) && !file_exists($_GET['f']) ) {
		$message .= '<div class="alert alert-danger">Unknown file "'.$_GET['f'].'".</div>';
	}

	if ( isset($_GET['f']) && file_exists($_GET['f']) && !is_writable($_GET['f']) ) {
		$message .= '<div class="alert alert-warning">I am unable to write to the file "'.$_GET['f'].'".</div>';
	}
}

include '../includes/header.php';
?>

<section id="security" class="container">
	<?php echo $message; ?>

    <div class="center">
        <h2>File Editor</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>

    <hr>

    <div class="row">
    	<div class="col-md-4">
    	<ul>
    	<?php
    		function printDir($dir) {
    			foreach ( glob($dir.'/*') AS $filename ) {
    				if ( is_dir($filename) ) {
    					printDir($filename);
    				} else {
    					// Only list .php files to edit
    					if ( substr($filename, -4) == '.php' ) {
    						$fn = realpath($filename);
	    					echo '<li><a href="/admin/editor.php?f='.$fn.'">'.$fn.'</a></li>';
    					}
    				}
    			}
    		}

    		// Default: parent directory
    		printDir(isset($_GET['dir']) ? $_GET['dir'] : '..');
    	?>
    	</ul>
    	</div>

    	<div class="col-md-6">
    		<form method="post">
    			<input type="hidden" name="filename" value="<?php echo isset($_GET['f']) ? $_GET['f'] : ''; ?>" />
    			<div class="form-group">

<textarea class="form-control" name="contents" rows="25">
<?php
	if ( !isset($_GET['f']) ) {
		echo 'Please select a file on the right hand side!';
	} else {
		echo file_get_contents($_GET['f']);
	}
?>
</textarea>

    			</div>

    			<div class="form-group">
	    			<button type="submit" class="btn btn-default pull-right">Save Changes</button>
	    		</div>
    		</form>
    	</div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>