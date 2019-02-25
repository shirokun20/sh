<?php

/**
 * Created By Shiro
 */
class Libikeh
{
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }


    public function to_json($data)
    {
    	return json_encode($data);	
    }
}
