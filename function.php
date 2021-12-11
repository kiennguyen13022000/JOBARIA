<?php
function pre ($expression, $wrap = true){
    $css = 'border:1px dashed #06f;padding:1em;text-align:left;';
    if ($wrap) {
        $str = '<p style="' . $css . '"><tt>' . str_replace(
                array('  ', "\n"), array('&nbsp; ', '<br />'),
                htmlspecialchars(print_r($expression, true))
            ) . '</tt></p>';
    } else {
        $str = '<pre style="' . $css . '">'
            . htmlspecialchars(print_r($expression, true)) . '</pre>';
    }
    echo $str;
}

