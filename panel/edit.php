<?php
// This page is mostly copied from ../admin/edit.php

require '../includes/panel_nav.php';

$title = 'Update Profile | Office of Blue Team Management';
$curnav = 'Update Profile';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();

$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute(array($curuserid));

if ( $stmt->rowCount() != 1 ) {
    die('An unknown error occured.');
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
        $values[] = $curuserid;

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
        <h2>Update Profile</h2>
        <p>Welcome <?php echo $curusername; ?>!</p>
    </div>

    <hr>

    <?php if ( !empty($_POST) ): ?>
    <div class="alert alert-success">Updated profile!</div>
    <?php endif; ?>

    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password" id="password" value="">
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