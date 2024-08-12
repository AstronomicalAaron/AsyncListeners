<?php

declare(strict_types=1);

global $entityManager;

require "bootstrap.php";

use App\PurchasePlan\Entity\PurchasePlan;
use App\User\Entity\User;

$purchasePlan = $entityManager->getRepository(PurchasePlan::class)
    ->findOneBy(['name' => 'free']);

$user = new User(
    'fooBar',
    password_hash('password', PASSWORD_BCRYPT),
    $purchasePlan->getPurchasePlanId(),
);

$entityManager->persist($user);
$entityManager->flush();
