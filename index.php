<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>STC ONLINE</title>
</head>
<body>

    <?php 
        include('navbar.php');
    ?>
    
    <?php 
        if (isset($_REQUEST['p'])) {
            include($_REQUEST['p']. '.php');
        }else{
    ?>

    <?php 
        include('dashboard.php');
    }
    ?>

    <?php 
        include('footer.php');
    ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>