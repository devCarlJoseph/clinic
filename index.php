<?php

require_once __DIR__ . '/app/Controllers/UserController.php';

$controller = new UserController();

$dentalUsers = $controller->index();

include __DIR__ . '/views/layouts/header.php';
?>

<h1>Dental Clinic Management System</h1>

<p class="subtitle">
    PHP OOP Demonstration: Inheritance and Polymorphism
</p>

<div class="users">

    <?php foreach ($dentalUsers as $user): ?>

        <div class="card">

            <div class="role">
                <?= htmlspecialchars($user->getRoleDescription()) ?>
            </div>

            <div class="info">
                <strong>Name:</strong>
                <?= htmlspecialchars($user->getName()) ?>
            </div>

            <div class="info">
                <strong>Contact:</strong>
                <?= htmlspecialchars($user->getContactNumber()) ?>
            </div>

        </div>

    <?php endforeach; ?>

</div>

<?php

include __DIR__ . '/views/layouts/footer.php';
?>