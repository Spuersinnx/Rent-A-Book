<?php
require_once ("../db/db_config.php");

function RegisterUser() {
    if(!isset($_POST['submitted']))
    {
        return false;
    }
    $formVars = array();
    if(!$this->ValidateRegistrationSubmission())
    {
        return false;
    }
    $this->CollectRegistrationSubmission($formVars);
    if(!$this->SaveToDatabase($formVars))
    {
        return false;
    }
    if(!$this->SendUserConfirmationEmail($formVars))
    {
        return false;
    }
    $this->SendAdminEmail($formVars);
    return true;
}




?>