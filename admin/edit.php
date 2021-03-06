<?php
require '../includes/admin_nav.php';

$title = 'Personnel Management | Office of Blue Team Management';
$curnav = 'Personnel Management';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();
requireAdmin();

if ( !isset($_GET['id']) || !is_numeric($_GET['id']) ) {
    header('Location: /admin/people.php');
    die;
}

$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute(array($_GET['id']));

if ( $stmt->rowCount() != 1 ) {
    header('Location: /admin/people.php');
    die;
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ( !empty($_POST) ) {
    $query = 'UPDATE users SET %s WHERE id = ?';

    $params = array();
    $values = array();

    foreach ( $_POST AS $key => $val ) {
        if ( empty($val) ) continue;
        if ( $user[$key] == $val ) continue;

        if ( $key == 'password' ) $val = sha1($val);

        $params[] = $key.' = ?';
        $values[] = $val;
    }

    if ( !empty($values) ) {
        $values[] = $_GET['id'];

        $query = sprintf($query, implode(',', $params));
        $stmt = $db->prepare($query);
        $stmt->execute($values);

        if ( $stmt->rowCount() == true ) {
            $user = $_POST;
        } else {
            die('Failed to update the DB');
        }
    }
}

include '../includes/header.php';
?>

<section id="security" class="container">
    <div class="center">
        <h2>Personnel Management</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>

    <hr>

    <?php if ( !empty($_POST) ): ?>
    <div class="alert alert-success">Updated user!</div>
    <?php endif; ?>

    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $user['username']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password" id="password" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="admin" class="col-sm-2 control-label">Is Admin (1 = Is Admin)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="admin" id="admin" value="<?php echo $user['admin']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="ssn" class="col-sm-2 control-label">SSN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ssn" id="ssn" value="<?php echo $user['ssn']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $user['phone']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="address" id="address" rows="3"><?php echo $user['address']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </div>
    </form>
</section>

<?php include '../includes/footer.php'; ?>