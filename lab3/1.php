<?php

$very_bad_unclear_name = "15 chicken wings";

$order = &$very_bad_unclear_name;
$order .= ', big coke and large fries';

echo "\nYour order is: $very_bad_unclear_name.\n";