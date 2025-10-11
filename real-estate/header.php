<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >


<header class="bg-primary text-white py-3">
<div class="container d-flex align-items-center justify-content-between">
<h1 class="h4 mb-0"><a href="<?php echo esc_url(home_url('/')); ?>" class="text-white text-decoration-none"><?php bloginfo('name'); ?></a></h1>
<nav>
<?php
wp_nav_menu(array('theme_location'=>'primary','container'=>false,'menu_class'=>'nav'));
?>
</nav>
</div>
</header>


<main class="site-main">
<div class="container py-4">