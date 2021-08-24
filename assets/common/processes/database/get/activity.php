<?php

    function get_last_activity_time($id): string
    {
        $id = checkInput('DEFAULT', $id);

        $date = strtotime(get_user_last_seen($id));
        $now = time();

        return $now - $date;
    }

    function get_activity_colour($id): string
    {
        $id = checkInput('DEFAULT', $id);

        $lastActivity = get_last_activity_time($id);

        if ($lastActivity <= '1800') {
            return 'green'; // Online
        } elseif ($lastActivity > '1800' && $lastActivity <= '3600') {
            return 'yellow'; // Idle
        } elseif ($lastActivity > '3600') {
            return 'red'; // Offline
        } else {
            return 'blue'; // Unknown result
        }
    }
