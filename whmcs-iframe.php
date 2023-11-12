<?php

/**
 * Template Name: WHMCS iframe
 * iframe for WHMCS
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>
<iframe src="https://control.giaiphapweb.vn/cart.php?a=add&domain=register&query=<?= $_REQUEST["query"] ?? ""; ?>"
        style="
        position: fixed;
        top: 0px;
        bottom: 0px;
        right: 0px;
        width: 100%;
        border: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        z-index: 999999;
        height: 100%;
      ">
</iframe>
</body>
</html>
