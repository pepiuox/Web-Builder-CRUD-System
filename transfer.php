<?php
@ini_set('max_execution_time', 0);

$message = null;

if (isset($_POST['source']) && isset($_POST['destination'])) {

    $transfer = true;
    $source = $_POST['source'];
    $destination = $_POST['destination'];

    $source_ext = pathinfo($source, PATHINFO_EXTENSION);
    $source_ext = pathinfo($source, PATHINFO_EXTENSION);
    $destination_ext = pathinfo($destination, PATHINFO_EXTENSION);


    if (!filter_var($source, FILTER_VALIDATE_URL)) {

        $transfer = false;
        $message = '<div class="alert alert-danger text-center">Your source is not a valid URL</div>';
    } else
    if ($source_ext != 'zip') {

        $transfer = false;
        $message = '<div class="alert alert-danger text-center">Your source is not a ZIP File</div>';
    } else
    if ($destination_ext != 'zip') {

        $transfer = false;
        $message = '<div class="alert alert-danger text-center">Your destination filename is not a ZIP Format</div>';
    }

    if ($transfer) {

        if (copy($source, $destination)) {

            $message = '<div class="alert alert-success text-center">Your requested file has been transfered.</div>';
        }
    }
}
?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Server File Transfer By pepiuox.net</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container content">

        <h1 class="h3 bg-primary text-center" style="padding: 5px;">Easy Server File Transfer By pepiuox.net</h1>
        <?php echo $message; ?>
        <div class="text-center">

            <form method="post">

                <div class="form-group">
                    <label for="source">ZIP File Link</label>
                    <input type="text" name="source" class="form-control" placeholder="http://example.com/file.zip" required="required">
                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" class="form-control" placeholder="newfile.zip or directory/newfile.zip" required="required">
                </div>

                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-transfer"></i> Transfer</button>
            </form>

        </div>
        <div class="footer text-center">&copy; 2015-<?php echo date('Y'); ?> <a target="_blank" href="https://pepiuox.net">pepiuox.net</a></div>
</body>

</html>
