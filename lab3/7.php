<?php

function printStringReturnNumber(): int {
    echo "Строка \n";
    return 100;
}

$my_num = printStringReturnNumber();
echo $my_num;