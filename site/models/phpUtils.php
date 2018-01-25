<?php

function parse_month($month)
{
    
    $monthArr = [
        '',
        'January',
        'Februari',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'Oktober',
        'November',
        'December'
    ];
    
    return $monthArr[$month];
    
}


function singleNumber($month)
{
    
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    $getMonth = str_replace('01', 'January', $month);
    
    
    return $getMonth;
    
}

function array_unique_multidimensional($input)
{
    
    $serialized = array_map('serialize', $input);
    $unique     = array_unique($serialized);
    
    return array_intersect_key($input, $unique);
}

function zerofill($mStretch, $iLength = 2)
{
    $sPrintfString = '%0' . (int)$iLength . 's';
    return sprintf($sPrintfString, $mStretch);
}