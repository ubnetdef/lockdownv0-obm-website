<?php
require '../includes/admin_nav.php';

$title = 'Office of Blue Team Management';
$curnav = 'Admin Home';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();
requireAdmin();

include '../includes/header.php';
?>

<section id="security" class="container">
    <div class="center">
        <h2>Admin Control Panel</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>
</section>

<?php include '../includes/footer.php'; ?>