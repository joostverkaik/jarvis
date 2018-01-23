<?php

require "site/core/controller.php";

class routing extends controller
{
    
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    
    public function home()
    {
        
        $this->render("public", "home");
        
    }
    
    
}
