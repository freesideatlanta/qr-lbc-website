<?php

$asset=new Asset();
$asset->id = 1;
$asset->tag='A7FID08';
$asset->name='Chair';
$asset->quantity=4;

// POST
if (!$asset->save())
{
    die('FAILURE');
}
