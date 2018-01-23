<?php

class mediaServerRoute
{
    
    private $pageName;
    
    public function __construct()
    {
        
        $this->route();
        
    }
    
    
    public function route()
    {
        
        require "site/controllers/routing.php";
        $Routing = new routing();
        
        if (isset($_GET['page']) AND $_GET['page'] != "") {
            
            $this->pageName = $_GET['page'];
            
            if ($this->pageName == "home") {
                
                $Routing->home();
                
            }
            
        } else if ($this->pageName == "") {
            
            $Routing->home();
            
        } else {
            
            echo "URL don't exist";
            
        }
        
    }
    
}

 
