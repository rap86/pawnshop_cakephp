<?php
/** 
 * easy_app_controller.php
 *
 * @author 		Teody Miranda
 * @copyright	
 * @license 	
 * @package		
 * @link		
 */

class PrintAppController extends AppController {
	var $components = array('Session','Auth');
	var $helpers = array('Html', 'Form', 'Javascript', 'Session', 'Paginator');
}
 
?>