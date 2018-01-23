<?php

function send_mail($headMail, $body, $sender_name, $sender_email, $receiver_email)
{
    
    if ( !preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#",
        $sender_email)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }
    
    
    $messages = "

                          <html>
                            <body>
                              <header>
                              <h1>" . $headMail . "</h1><br/>
                                 <p style='color: #030303, font-size: 18px'>

                                   " . $body . "

                                 </p>

                              </header>
                           </body>
                         </html>


                       ";
    $boundary = "-----=" . md5(rand());
    
    
    $header = "From: \"" . $sender_name . "\"<" . $sender_email . ">" . $passage_ligne;
    $header .= "Reply-to: \"" . $sender_name . "\"<" . $sender_email . ">" . $passage_ligne;
    $header .= "MIME-version: 1.0" . $passage_ligne;
    $header .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
    $header .= "Content-type: multipart/alternative;" . $passage_ligne . "boundary=\"$boundary\"" . $passage_ligne;
    $header .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    
    $message = $passage_ligne . "--" . $boundary . $passage_ligne;
    $message .= $passage_ligne . $messages . $passage_ligne;
    
    mail($receiver_email, $headMail, $message, $header);
    
    
}
    
