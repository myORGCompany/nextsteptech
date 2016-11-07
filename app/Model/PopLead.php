 <?php

App::uses('AppModel', 'Model');

class PopLead extends AppModel {

    var $name = 'PopLead';
    
    var $assocs = array();
    function checkPopEntryByMobile($data = null){
        $isMember = false;
        $popData = $this->find('first', array(
            'fields' => array("id"),
            'conditions' => array('mobile' => $data)
        ));
        //print_r($popData);die;
        if (isset($popData['PopLead']['id']) && (int) $popData['PopLead']['id']) {
            $isMember = (int) $popData['PopLead']['id'];
        }
        return $isMember;
    }
}
