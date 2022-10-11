<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Base;

class Deactivate
{
    public static function deactivate()
    {
        //Flush rules
        flush_rewrite_rules();
    }
}
