<?php

function rand_color() {
        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

$dummy = array();

for ($i = 0; $i < 20; ++$i)
{
    $h = $i + 1;

    $dummy[] = array(
        'id'=>$i,
        'name'=>"Asset $i",
        'summary'=>"Summary for asset $i, summary for asset $i, summary for asset $i",
        'url'=>"/asset/$i",
        'photos'=>array('http://dummyimage.com/600x400&text=%20/'.rand_color()),
        'attributes'=>array(
            'Size'=>'',
            'Qty. Available'=>'43',
            'Price'=>$h*100,
        ),
    );
}

return $dummy;
