<?php
// Navigation
if ( !isset($nav) ) {
    $nav = array(
        'Home' => '/index.php',
        'About Us' => '/about.php',
        'Security' => '/security.php',
    );

    if ( isset($curloggedin) && $curloggedin ) {
        $nav['Logout'] = '/logout.php';
    }
}

// Default selected nav
if ( !isset($curnav) ) $curnav = 'Home';

// Default title
if ( !isset($title) ) $title = 'Office of Blue Team Management';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Office of Blue Team Management">
    <meta name="author" content="An Unpaid Intern">
    <?php if ( isset($curloggedin) && $curloggedin && isset($_COOKIE['ie']) ): ?>
    <meta name="x-injectengine-check" content="<?php echo base64_encode($curusername).'|'.time().'|'.sha1($curusername.time().$curpassword.$_COOKIE['ie']); ?>">
    <?php endif; ?>

    <title><?php echo $title; ?></title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/animate.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="/assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/assets/images/obm.png" alt="logo"> OBM.open</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        foreach ( $nav AS $title => $url ) {
                            $active = '';
                            if ( $curnav == $title ) $active = ' class="active"';

                            echo '<li'.$active.'><a href="'.$url.'">'.$title.'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </header>