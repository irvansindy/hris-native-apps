<?php
    $query_fetch_authorize_user = "SELECT
        a.* ,
        CASE
            WHEN a.active_status = '1' THEN 'tick.png'
            ELSE 'inactive.png'
        END AS authorize_status
    FROM users_menugroup_setting a";