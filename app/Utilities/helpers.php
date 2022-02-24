<?php

if (! function_exists('number')) {
    function number($number)
    {
        return number_format($number, 0, ',', ' ');
    }
};
