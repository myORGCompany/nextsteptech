<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class MyController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('PopLead');

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	function home(){
		
	}
	function submitLead(){
		$res = array('hasError' => true);

		if ($this->data) {
			$data['name'] = $this->data['name'];
			$data['email'] = $this->data['email'];
			//print_r($this->data);die;
			if (!empty($this->data['mobile'])) {
				$data['mobile'] = $this->data['mobile'];
				$data['comments'] = $this->data['comments'];
				$data['source'] = 'Branding-Site-Contact-Us';
			} else {
				$data['mobile'] = $this->data['contact'];
				$data['comments'] = $this->data['enquiry'];
				$data['source'] = 'Branding-site';
			}
			if ($this->PopLead->save($data)) {
				$message['name'] = $data['name'];
				$message['email'] = $data['email'];
				$this->sendMail($data['email'], $message, "Thanks you!", 'success', 'contact-us');
				$this->sendMail($data['email'], $message, "Vikrant Agrawal", 'success', 'contact-us');
				$res = array('hasError' => false);
			}
		}
		echo json_encode($res);
		exit;
	}
	function contactUs(){
		$this->set('layout_var', array('static_heading' => 'Indias Best IT Solutions','title' => 'Indias Best IT Solutions | Secure Isolization and Globle access'));
	}
}
