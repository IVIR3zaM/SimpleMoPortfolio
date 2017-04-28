<?php
// this is only a file with heavy calculation for testing cpu overload
$t = 0;
for ($i = 0; $i < 1000000; $i++) {
    $t = pow(3, mt_rand(0, 26));
}
echo $t . "\n";