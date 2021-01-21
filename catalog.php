<?php

echo renderTemplate('layout', renderTemplate('menu'), renderTemplate('catalog'));

function renderTemplate($page, $menu = '', $content = '')
{
    ob_start();
    include "./templates/{$page}.php";
    return ob_get_clean();
}