<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Base;

class Activate
{

    public static  function activate()
    {
        //Flush rules
        flush_rewrite_rules();
    }
}
