<?php

use CRM_Summary_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Summary_Form_DateRange extends CRM_Core_Form {
  public function buildQuickForm() {

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));


    $this->add('datepicker', 'start_date', 'Start Date', ['Y-m-d'], false, ['time' => false]);
    $this->add('datepicker', 'end_date', 'End Date', ['Y-m-d'], false, ['time' => false]);

    $entityArray = [
          'Contact' => 'created_date',
          'Event' => 'created_date',
          'Activity' => 'created_date',
          'Case' => 'created_date',
          'Contribution' => 'receive_date',
          'Membership' => 'start_date',
          'MembershipType' => ['source', 'start_date'],
    ];
      $params = [
      ];

    foreach($entityArray as $key => $value ) {
          $entityResult[$key] = civicrm_api3( $key, 'getcount', $params);
      }
      $this->assign('startResults', $entityResult );
    parent::buildQuickForm();
  }

  public function postProcess() {
    $values = $this->exportValues();
    $params = [];
    if (!empty($values['start_date'])) {
        $params = [
            'created_date' => ['>=' => $values['start_date']],
            'receive_date' => ['>=' => $values['start_date']],
            'start_date' => ['>=' => $values['start_date']],
            'source' => "Donation",
        ];
    }
    if (!empty($values['end_date'])){
        $params = [
            'created_date' => [ '<=' => $values['end_date']],
            'receive_date' => ['<=' => $values['end_date']],
            'start_date' => ['<=' => $values['end_date']],
            'source' => "Donation",
        ];
    }
        $entityArray = [
            'Contact' => 'created_date',
            'Event' => 'created_date',
            'Activity' => 'created_date',
            'Case' => 'created_date',
            'Contribution' => 'receive_date',
            'Membership' => 'start_date',
            'MembershipType' => ['source', 'start_date'],
        ];
        $entityResult = [
        ];
        foreach($entityArray as $key => $value ) {
            $entityResult[$key] = civicrm_api3( $key, 'getcount', $params);
        }
        $this->assign('allResults', $entityResult );
        $this->assign('startDate', $values['start_date']);
        $this->assign('endDate', $values['end_date']);
        $default_search_email = Civi::settings()->get('email_address2');
        $default_tpl_id_search = Civi::settings()->get('template_id2');

        $currentContactID = CRM_Core_Session::getLoggedInContactID();
        $contactDetails = CRM_Contact_BAO_Contact_Location::getEmailDetails($currentContactID);
        $userEmail = $contactDetails['1'];
        $emailParams = [
            'messageTemplateID' => $default_tpl_id_search,
            'tplParams' => $entityResult,
            'toEmail' => $userEmail,
            'from' => $default_search_email,
            'subject' => 'Filter results'
        ];

        CRM_Core_BAO_MessageTemplate::sendTemplate($emailParams);
    parent::postProcess();
  }


  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */

}
