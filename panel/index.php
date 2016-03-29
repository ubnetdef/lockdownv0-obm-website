<?php
require '../includes/panel_nav.php';

$title = 'Office of Blue Team Management';
$curnav = 'User Panel Home';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();

include '../includes/header.php';
?>

<section id="security" class="container">
    <div class="center">
        <h2>User Control Panel</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>
</section>

<?php include '../includes/footer.php'; ?>