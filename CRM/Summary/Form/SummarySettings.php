<?php
use CRM_Summary_ExtensionUtil as E;

class CRM_Summary_Form_SummarySettings extends CRM_Core_Form {
    public function buildQuickForm() {
        $email = CRM_Core_OptionGroup::values('from_email_address', NULL, NULL, NULL);
        foreach ($email as &$value){
            $value = htmlspecialchars($value);
        }
        $result = civicrm_api3('MessageTemplate', 'get', [
            'return' => ["id", "msg_title"],
            'workflow_id' => ['IS NULL' => 1],
        ]);
        foreach ($result['values'] as $item ) {
            $template[$item['id']] = $item['msg_title'];
        }
        $this->add('select','from_email_address', ts('Address for BirthDay mailings'), $email, FALSE, ['class' => 'crm-select2']);
        $this->add('select','from_email_address2', ts('Address for Filter Results mailings'), $email, FALSE, ['class' => 'crm-select2']);
        $this->add('select','template_id', ts('Template for BirthDay mailings'), $template, FALSE, ['class' => 'crm-select2']);
        $this->add('select','template_id2', ts('Template for Filter Results mailings'), $template, FALSE, ['class' => 'crm-select2']);
        $this->addButtons(array(
            array(
                'type' => 'submit',
                'name' => E::ts('Submit'),
                'isDefault' => TRUE,
            ),
        ));

        parent::buildQuickForm();
    }
    public function setDefaultValues(){
        $defaults = [
            'template_id' =>  Civi::settings()->get('template_id'),
            'template_id2' =>  Civi::settings()->get('template_id2'),
            'from_email_address' => Civi::settings()->get('email_address'),
            'from_email_address2' => Civi::settings()->get('email_address2'),
        ];
        return $defaults;
    }

    public function postProcess(){
        $values = $this->exportValues();
        Civi::settings()->set('email_address', $values['from_email_address']);
        Civi::settings()->set('email_address2', $values['from_email_address2']);
        Civi::settings()->set('template_id', $values['template_id']);
        Civi::settings()->set('template_id2', $values['template_id2']);
    }


}