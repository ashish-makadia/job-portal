<!DOCTYPE html>
<html>
<head>
    <title>Job Board</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">JobBoard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\wamp64\www\job-board\resources\views/layouts/app.blade.php ENDPATH**/ ?>