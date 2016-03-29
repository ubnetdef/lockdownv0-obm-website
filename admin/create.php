<?php
require '../includes/admin_nav.php';

$title = 'Personnel Management | Office of Blue Team Management';
$curnav = 'Personnel Management';

include '../includes/session.php';

// We must be logged in right now!
requireLogin();
requireAdmin();

if ( !empty($_POST) ) {
    $query = 'INSERT INTO users (%s) VALUES(%s)';

    $keys   = array();
    $params = array();
    $values = array();

    foreach ( $_POST AS $key => $val ) {
        if ( empty($val) ) continue;

        if ( $key == 'password' ) $val = sha1($val);

        $keys[] = $key;
        $params[] = '?';
        $values[] = $val;
    }

    if ( !empty($values) ) {
        $query = sprintf($query, implode(',', $keys), implode(',', $params));
        $stmt = $db->prepare($query);
        $stmt->execute($values);

        if ( $stmt->rowCount() == true ) {
            header('Location: /admin/people.php');
            die;
        } else {
            die('DB insert error');
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

    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" value="">
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
                <input type="text" class="form-control" name="admin" id="admin" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="ssn" class="col-sm-2 control-label">SSN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ssn" id="ssn" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" id="phone" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Create</button>
            </div>
        </div>
    </form>
</section>

<?php include '../includes/footer.php'; ?>