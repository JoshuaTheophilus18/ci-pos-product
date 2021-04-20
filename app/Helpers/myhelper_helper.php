<?php
if (!function_exists('nomor')) {
    function nomor($currentPage, $perPage)
    {
        if (is_null($currentPage)) {
            $nomor = 1;
        } else {
            $nomor = 1 + ($perPage * ($currentPage - 1));
        }
        return $nomor;
    }
}

function mark_nav_active($uri, $currentURL = null, $class = 'active') {
    if (is_null($currentURL)) {
        $currentURL = current_url();
    }

    return !empty(strpos($currentURL, $uri)) ? $class : '';
}