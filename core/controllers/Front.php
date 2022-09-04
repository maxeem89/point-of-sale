<?php 
/**
 * Front controller class: controlles the workflow of the public requests in index.php
 */
namespace Core\Controllers;
use Core\Base\Controller;
use Core\Base\View;

class Front extends Controller{
    // Handle the "/" user request.
    // get the needed data from the DB.
    // get the view.

    public function render() : View {
        return $this->view($this->view, $this->data);
    }

  

   
  

    
    


}
