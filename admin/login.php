<?php
require '../includes/admin_nav.php';

$title = 'Office of Blue Team Management';
$curnav = 'Login Page';
$worked = true;
$help = '';

include '../includes/session.php';

if ( isset($_GET['username']) && isset($_GET['password']) ) {
	$username = $_GET['username'];
	$securepass = sha1($_GET['password']);

	$worked = tryLogin($username, $securepass, $help);

	if ( $worked ) {
		header('Location: /admin');
		die;
	}
}

include '../includes/header.php';
?>

<section id="security" class="container">
    <div class="center">
        <h2>Secure OBM Login System</h2>
        <p>Please enter your username and password.</p>
    </div>

    <?php if ( !$worked ): ?>
    <div class="alert alert-danger">Username / Password is incorrect. Did you forget your password again? <?php echo $help; ?></div>
    <?php endif; ?>

    <form class="form-horizontal">
    	<div class="form-group">
    		<label for="username" class="col-sm-2 control-label">Username</label>
    		<div class="col-sm-10">
    			<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>">
    		</div>
    	</div>

    	<div class="form-group">
    		<label for="password" class="col-sm-2 control-label">Password</label>
    		<div class="col-sm-10">
    			<input type="password" class="form-control" name="password" id="password" placeholder="SecretPassword123!" value="<?php echo isset($_GET['password']) ? $_GET['password'] : ''; ?>">
    		</div>
    	</div>

    	<div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-10">
	    		<button type="submit" class="btn btn-default">Sign in</button>
	    		<a href="/admin/register.php" class="btn btn-default">Register</a>
	    	</div>
    	</div>
    </form>
</section>

<?php include '../includes/footer.php'; ?>