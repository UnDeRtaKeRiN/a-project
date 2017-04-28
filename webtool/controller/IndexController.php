<?php
require_once('Validation.php');

class IndexController extends ViewController
{
    public function ticketaction()
    {
        $Validation = new Validation(
            'ticketform',
            array('salutation', 'prename', 'surname', 'customerid', 'email', 'ticketqueue', 'subject', 'ticketmessage')
        );

        $this->templating->assign('queues', $this->getPossibleQueues());
        $this->templating->assign('categories', $this->getPossibleCategories());
        $this->templating->assign('topics', $this->getPossibleTopics());
        $this->templating->assign('hideCode', false);
        $this->templating->assign('nologin', false);

        $Validation->addValidationRule('salutation', 'salutation', 'Absenden nicht möglich. Bitte wählen Sie eine Anrede aus.');
        $Validation->addValidationRule('prename', 'prename', 'Absenden nicht möglich. Bitte geben Sie einen Vornamen ein.');
        $Validation->addValidationRule('surname', 'surname', 'Absenden nicht möglich. Bitte geben Sie einen Nachnamen ein.');
        $Validation->addValidationRule('email', 'email', 'Absenden nicht möglich. Bitte geben Sie eine gültige Emailadresse ein.');
        $Validation->addValidationRule('ticketqueue', 'queue', 'Absenden nicht möglich. Bitte geben Sie einen Problembereich aus.');
        $Validation->addValidationRule('subject', 'subject', 'Absenden nicht möglich. Bitte geben Sie einen Betreff ein.');
        $Validation->addValidationRule('ticketmessage', 'ticketmessage', 'Absenden nicht möglich. Bitte geben Sie Ihre Nachricht ein.');

        $LoginValidation = new Validation(
            'loginform',
            array('username')
        );

        $LoginValidation->addValidationRule('username', 'username', 'Benutzername ist ein Pflichfeld');
        $LoginValidation->addValidationRule('password', 'password', 'Passwort ist ein Pflichtfeld');

        if (isset($_POST['loginform']['submitted']))
        {
            $LoginValidation->validate();

            if (!count($LoginValidation->getErrors()))
            {
                $statement = $this->database->prepare('SELECT * FROM customer WHERE email = ? LIMIT 1');
                $statement->execute(array($LoginValidation->getSubmitValue('username')));

                $result = $statement->fetch(PDO::FETCH_ASSOC);


                if (!password_verify($_POST['loginform']['password'], $result['password']))
                {
                    $this->templating->assign('nologin', true);
                }
                else
                {
                    if ($result != '')
                    {
                        $_POST['ticketform']['salutation'] = $result['salutation'];
                        $_POST['ticketform']['email'] = $result['email'];
                        $_POST['ticketform']['prename'] = $result['prename'];
                        $_POST['ticketform']['surname'] = $result['surname'];
                        $_POST['ticketform']['customerid'] = $result['customerid'];
                        $this->templating->assign('hideCode', true);
                    }
                    $Validation->validate();
                }
            }
        }


        if (isset($_POST['ticketSend']))
        {
            $Validation->validate();
            if (!count($Validation->getErrors()))
            {
                $mailTemplate = clone $this->templating;
                $mailTemplate->assign('Form', $Validation);
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = "smtp.bla.de";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Username = "bla@bla.de";
                $mail->Password = "secured";
                $mail->From = $Validation->getSubmitValue('email');
                $mail->FromName = $Validation->getSubmitValue('prename') . ' ' . $Validation->getSubmitValue('surname');
                $mail->AddAddress("bla@bla.de");
                $mail->Subject = $Validation->getSubmitValue('subject');
                $mail->Body = $mailTemplate->fetch('mail.tpl');
                $mail->isHTML(true);

                if (!$mail->Send())
                {
                    //$mail->Send() liefert FALSE zurück: Es ist ein Fehler aufgetreten
                    echo "Die Email konnte nicht gesendet werden";
                    echo "Fehler: " . $mail->ErrorInfo;
                }
                else
                {
                    //$mail->Send() liefert TRUE zurück: Die Email ist unterwegs
                    $this->templating->assign('mail', true);
                    $this->templating->display('ticketsuccess.tpl');
                    die;
                }
            }
        }

        // Nun benutzen wir die Smarty-Methoden direkt.
        // Das kann alles was wir brauchen.
        // Vorteil: Wir halten und ans SRP https://de.wikipedia.org/wiki/Single-Responsibility-Prinzip
        // Bisher war der Controller fürs Rendern der Templates zuständig. Nun ist es die Template-Engine
        // direkt. Das entkoppelt das Ganze und man kann theoretisch $this->templating auch einfach eine andere
        // template engine zuweisen.
        // Theoretisch sollte das Zusammenbauen des Smarty-Objekts auch nicht im Controller passieren, sondern
        // in einer Factory https://de.wikipedia.org/wiki/Fabrikmethode oder in einem
        // DiC (beste Lösung). Aber das ist alles eine Ebene zu Hoch für den Anfang.
        // Merksatz: In 98% der Fälle macht man etwas falsch wenn man "extends" verwendet!!!

        $this->templating->assign('validation', $Validation);
        $this->templating->assign('loginvalidation', $LoginValidation);
        $this->templating->display('ticketform.tpl');
    }

    private function getPossibleQueues()
    {
        $statement = $this->database->prepare('SELECT * FROM queue');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getPossibleCategories()
    {
        if(! isset($_POST['ticketform']['ticketqueue'])) {
            return array();
        }

        $statement = $this->database->prepare('SELECT * FROM category WHERE queue_id = ?');
        $statement->execute(array($_POST['ticketform']['ticketqueue']));

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getPossibleTopics()
    {
        if(! isset($_POST['ticketform']['category'])) {
            return array();
        }

        $statement = $this->database->prepare('SELECT * FROM topic WHERE category_id = ?');
        $statement->execute(array($_POST['ticketform']['category']));

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

