<?php

  function wp_path()
      {
      if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/"))
          {
          return preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
          }
      return preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
      }
  require wp_path() . "/wp-load.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // Error messages
    $email = $_POST['email'];
    global $phone;
    if(isset($_POST['phone'])){ $phone = $_POST['phone']; }
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    if(isset($_POST['room'])){ $room = $_POST['room']; }
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      echo '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. esc_html__("Attention! Please enter a valid email address.", 'starhotel') . '</div>';
      exit();
    }
    else
    if (isset($room) == '')
      {
      echo '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . esc_html__("Attention! Please enter your room.", 'starhotel' ) . '</div>';
      exit();
      }
    else
    if (trim($checkin) == '')
      {
          echo '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . esc_html__("Attention! Please enter your check-in date.", 'starhotel' ) . '</div>';
          exit();
      }
    else
    if (trim($checkout) == '')
      {
          echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . esc_html__("Attention! Please enter your check-out date.", 'starhotel' ) . '</div>';
          exit();
      }


    // If phone number enabled
    $phone_content = isset($_POST['phone_content']) ? $_POST['phone_content'] : '';
    if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { $phone_content = esc_html__("
You can call the client at the following phone number: ", 'starhotel') . "$phone" ; } else {}
    // Your e-mailadress.
    $recipient = $sh_redux['reservation-recipient-mail'];
    $subject = esc_html__("Good news! A reservation has been requested by ", 'starhotel') . "$email";
    // Mail content
    $email_content = esc_html__("Good news! A reservation has been requested by ", 'starhotel') . "$email"

    .
esc_html__("

The customer wants to check-in at: ", 'starhotel') . "$checkin" . esc_html__(" and check-out at: ", 'starhotel') . "$checkout" .
esc_html__("

The customer requested a ", 'starhotel') . "$room" . esc_html__(" room for ", 'starhotel') . "$adults" . esc_html__(" adult(s) and ", 'starhotel') . "$children" . esc_html__(" child(ren).", 'starhotel') .

esc_html__("

You can contact the customer via email, ", 'starhotel') . "$email" . esc_html__(" or hit reply in your email client to make the reservation complete.", 'starhotel') . "$phone_content";


    // Main messages
    if (wp_mail($recipient, $subject, $email_content))

    {
        echo '<h1>' . esc_html__("Reservation sent successfully!", 'starhotel' ) . '</h1>';
        echo '<p>' . esc_html__("Thank you, your reservation has been submitted to us and we'll contact you as quickly as possible to complete your booking.", 'starhotel' ) . '</p>';
    }
    else
    {
        echo '<p>' . esc_html__("Oops! Something went wrong and we couldn't send your reservation.", 'starhotel' ) . '</p>';
    }
  }
  else
  {
      echo '<p>' . esc_html("There was a problem with your submission, please try again.", 'starhotel' ) . '</p>';
  }

?>
