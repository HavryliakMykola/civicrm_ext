<?php

use CRM_Summary_ExtensionUtil as E;

function civicrm_api3_birthday_check_and_mailing_get_and_send($params){

    $query = "SELECT civicrm_contact.id, civicrm_contact.display_name, civicrm_email.email, civicrm_email.id
            FROM civicrm_contact
            INNER JOIN civicrm_email ON civicrm_email.contact_id = civicrm_contact.id
            WHERE MONTH(civicrm_contact.birth_date) = MONTH(CURRENT_DATE()) AND DAY(civicrm_contact.birth_date) = DAY(CURRENT_DATE())";
    $dao = CRM_Core_DAO::executeQuery($query);
    while ($dao->fetch()) {
        $all_contact[$dao->display_name] = $dao->email;
    }
    foreach ($all_contact as $name => $email){
        $emailParams = [
                    'messageTemplateID' => 70,
                    'toEmail' => $email,
            ];
        $smarty = CRM_Core_Smarty::singleton();;
        $smarty->assign('name', $name);
        CRM_Core_BAO_MessageTemplate::sendTemplate($emailParams);
    }
}