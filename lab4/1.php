<?php
$str = 'j123j jxxj jabcj jj j12j';
preg_match_all('/j...j/', $str, $matches);
print_r($matches[0]);