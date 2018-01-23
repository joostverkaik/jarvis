<?php

class controller
{
    
    public function __construct()
    {
        
        
    }
    
    
    protected function render($scoop, $page_name)
    {
        
        require "site/views/" . $scoop . "/" . $page_name . ".php";
        
    }
    
}
   