<?php
function dd(...$vars) {
    echo "<pre style='background:#222;color:#0f0;padding:10px;border-radius:5px;'>";
    foreach ($vars as $v) {
        var_dump($v);
        echo "\n";
    }
    echo "</pre>";
    die(); 
}
?>