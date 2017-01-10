#!/usr/bin/php
<?php
    include("ft_is_sort.php");

    $sorted1 = array("!/@#;^", "42", "Hello World", "salut", "zZzZzZz");
    $unsorted1 = array("!/@#;^", "42", "Hello World", "salut", "zZzZzZz", "Et qu'est-ce qu'on fait maintenant ?");
    $sorted2 = array("AAA", "Zer", "blorp", "dfwer", "zzzzzz");
    $unsorted2 = array("!/@#;^", "42", "hello World", "Salut", "ZzZzZzZ");

    if (ft_is_sort($sorted1))
        echo ("Le tableau sorted1 est trie\n");
    else
        echo ("Le tableau sorted1 n'est pas trie\n");

    if (ft_is_sort($unsorted1))
        echo ("Le tableau unsorted1 est trie\n");
    else
        echo ("Le tableau unsorted1 n'est pas trie\n");

    if (ft_is_sort($sorted2))
        echo ("Le tableau sorted2 est trie\n");
    else
        echo ("Le tableau sorted2 n'est pas trie\n");

    if (ft_is_sort($unsorted2))
        echo ("Le tableau unsorted2 est trie\n");
    else
        echo ("Le tableau unsorted2 n'est pas trie\n");
?>