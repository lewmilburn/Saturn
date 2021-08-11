<?php

    function send_email($email, $subject, $message): bool
    {
        if (CONFIG_EMAIL_FUNCTION == 'phpmail') {
            $to = $email;
            if (!isset($to)) {
                echo 'Email error: No recipient.';

                return false;
            }
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8'."\r\n";
            $headers .= 'From: '.CONFIG_EMAIL_SENDFROM."\r\n";
            $contents = '<html lang="en">
    <head>
        <title>'.$subject.'</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="w-full h-auto bg-gray-100 py-2 px-4 mb-4 flex">
            <img src="https://service.lmwn.co.uk/brandkit/saturn/logo.png" class="w-1/4 h-auto float-left" alt="Saturn">
            <span class="flex-grow text-right self-center text-4xl">'.CONFIG_SITE_NAME.'</span>
        </div>
        <div class="py-2 px-4">'.$message.'</div>
        <div class="py-20 px-4 text-xs italic">This message was sent because you have an account registered with a Saturn installation at "'.CONFIG_SITE_NAME.'". You may be able to opt-out of these emails in your user settings.</div>
    </body>
</html>';
            return mail($to, $subject, $contents, $headers);
        } elseif (CONFIG_EMAIL_FUNCTION == 'smtp') {
            echo 'SMTP is not implemented.';

            return false;
        } else {
            echo 'FATAL ERROR: Email function not specified correctly, please check your config.php file and visit docs.saturncms.net for help.';
            exit;
        }
    }
