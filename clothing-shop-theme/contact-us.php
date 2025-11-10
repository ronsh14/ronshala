<?php
/* Template Name: Contact Us */
get_header(); ?>

<div class="container">
  <h2>Contact Us</h2>
  <p>We’d love to hear from you! Fill out the form below or email us directly.</p>

  <form class="contact-form" method="post">
    <p><label for="name">Name</label><br>
    <input type="text" id="name" name="name" required></p>

    <p><label for="email">Email</label><br>
    <input type="email" id="email" name="email" required></p>

    <p><label for="message">Message</label><br>
    <textarea id="message" name="message" rows="5" required></textarea></p>

    <p><button type="submit">Send</button></p>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = get_option('admin_email');
    $subject = "Contact Form: $name";
    $headers = ['Reply-To: ' . $email];
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (wp_mail($to, $subject, $body, $headers)) {
      echo '<p style="color:green;">Thank you! Your message has been sent.</p>';
    } else {
      echo '<p style="color:red;">Something went wrong. Please try again later.</p>';
    }
  }
  ?>
</div>

<?php get_footer(); ?>
