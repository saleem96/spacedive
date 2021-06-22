<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>

    </style>
</head>
<body>
<p>Support Email</p>
<p><?php echo e(auth()->user()->fname . ' ' . auth()->user()->lname); ?></p>
<p><?php echo e(auth()->user()->email); ?></p>
<p>Message : <?php echo e($msg); ?></p>
</body>
</html>
<?php /**PATH /home/spacairt/my.spacedive.io/resources/views/emails/support.blade.php ENDPATH**/ ?>