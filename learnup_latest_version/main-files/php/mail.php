<?php


    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = strip_tags(trim($_POST["inputName"]));
                $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["inputEmail"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["inputMessage"]);


        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
           
            http_response_code(400);
            echo "Oops! There was a problem Please complete the form and try again.";
            exit;
        }

       
        $recipient = "youremail@gmail.com"; /** DON'T FORGET TO PUT YOUR EMAIL HERE **/

        $subject = "New message from $name";

     
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

    
        $email_headers = "From: $name <$email>";

        // Sending email
        if (mail($recipient, $subject, $email_content, $email_headers)) {
          
            http_response_code(200);
            echo "Great ! Your message has been sent !!";
        } else {
           
            http_response_code(500);
            echo "Oops! Something wrong and we couldn't send your message.";
        }

    } else {
        
        http_response_code(403);
        echo "There was a problem with your input, please try again.";
    }


?>