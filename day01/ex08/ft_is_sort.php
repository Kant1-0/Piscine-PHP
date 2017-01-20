<?php
    function ft_is_sort($arr) {
        $sorted = $arr;
        sort($sorted);
        if ($arr == $sorted)
            return true;
        else
            return false;
    }
?>