<?php

function format_rupiah($number, $prefix = 'Rp ')
{
    return $prefix . number_format($number, 0, ',', '.');
}
