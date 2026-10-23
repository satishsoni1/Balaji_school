<?php
require_once __DIR__ . '/data.php';

$pageTitle       = isset($pageTitle) ? $pageTitle : $school['name'] . ', ' . $school['place'];
$pageDescription = isset($pageDescription) ? $pageDescription : $school['about'];
$activePage      = isset($activePage) ? $activePage : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="theme-color" content="#7a1d24">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:image" content="assets/images/opt/hero-school.jpg">

    <link rel="icon" type="image/png" href="assets/images/logo_shri2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="assets/css/remixicon.css">
    <link rel="stylesheet" href="assets/css/site.css">
</head>
<body id="top">
<a class="skip-link" href="#main">Skip to content</a>
