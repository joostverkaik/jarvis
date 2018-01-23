<?php

class model
{
    
    private $pdo;
    
    public function __construct()
    {
        
        
    }
    
    public function error($error)
    {
        
        ?>

		<script type="text/javascript">

			window.addEventListener("load", function () {

				var error = document.querySelector(".error");
				error.innerHTML = "<?php echo $error;?>";
				error.style.color = "red";

			})

		</script>
        
        <?php
        
    }
    
    public function succes($succes)
    {
        
        ?>

		<script type="text/javascript">

			window.addEventListener("load", function () {

				var error = document.querySelector(".error");
				error.innerHTML = "<?php echo $succes;?>";
				error.style.color = "#00D636";

			})

		</script>
        
        <?php
        
    }
    
    public function post_value($name)
    {
        
        if (isset($_POST[$name])) {
            
            $inputname = $_POST[$name];
            
            return $inputname;
            
        }
        
        
    }
    
    protected function PDO()
    {
        
        if ($this->pdo === null) {
            
            $this->pdo = new PDO("mysql:host=localhost;dbname=jarvis", 'jarvis', 'JarvisUvA2018');//localhost
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        
        return $this->pdo;
        
    }
    
    public function prepare($statement, $data)
    {
        
        $prepare = $this->PDO()->prepare($statement);
        $prepare->execute($data);
        
        return $prepare;
        
        
    }
    
    public function query($statement)
    {
        
        $query = $this->PDO()->query($statement);
        $query->fetch();
        
        return $query;
        
        
    }
    
    protected function mainMap()
    {
        
        return "jarvis";
        
    }
    
}
