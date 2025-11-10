<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container">
    <h1 class="site-title">
      <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
    </h1>

    <!-- ✅ Added Horizontal Navigation Menu -->
    <nav class="main-nav">
      <ul>
        <li><a href="<?php echo home_url(); ?>">Home</a></li>
        <li><a href="<?php echo home_url('/about-us'); ?>">About Us</a></li>
        <li><a href="<?php echo home_url('/contact-us'); ?>">Contact Us</a></li> 

      </ul>
    </nav>
  </div>
</header>
