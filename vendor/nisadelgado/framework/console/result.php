<?php

$current = new Datetime();

$date = new Datetime('2020-12-01');
$interval = $current->diff($date);

echo $interval->format('%a');
