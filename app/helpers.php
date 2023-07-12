<?php

function hasActiveChild($routes)
{
    foreach ($routes as $route) {
        if (request()->route()->named($route)) {
            return true;
        }
    }

    return false;
}
