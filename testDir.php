<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['someAction']))
    {
        $out = array();
        foreach (glob('xmlFiles/*.xml') as $filename) {
            $p = pathinfo($filename);
            $out[] = $p['filename'];
        }
        
        echo $out[3];
    }
?>
