<?php 
    if ($srole == "Evaluator") {
        header("location:ssn/bridge.php?rel=evaluation");
    } elseif ($srole == "Encoder") {
        header("location:ssn/bridge.php?rel=encoding");
    } elseif ($srole == "Administrator") {
        header("location:ssn/bridge.php?rel=list");
    }
    return;
?>