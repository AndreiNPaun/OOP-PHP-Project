<?php
namespace Job\Controllers;
class Enquiry {
    private $enquiryTable;
    private $usersTable;

    public function __construct($enquiryTable, $usersTable) {
        $this->enquiryTable = $enquiryTable;
        $this->usersTable = $usersTable;
    }

    public function enquiry() {

        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {

            $enquiries = $this->enquiryTable->findAll();
            $user = $this->usersTable->find('id', $_SESSION['loggedin'])[0];
    
            return [
                'template' => 'admin/enquiry.html.php',
                'variables' => ['enquiries' => $enquiries, 'user' => $user],
                'title' => 'Jo\'s Jobs - List Enquiries'
            ];
        }

        else {
            header('location: /');
        }
    }

    public function archieve() {

        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {

            $enquiries = $this->enquiryTable->findAll();
            $staff = $this->usersTable->find('username', $_SESSION['username']);
    
            return [
                'template' => 'admin/archieve.html.php',
                'variables' => ['enquiries' => $enquiries],
                'title' => 'Jo\'s Jobs - List Enquiries'
            ];
        }

        else {
            header('location: /');
        }
    }

    public function answerEnquirySubmit() {
        $enquiry = $_POST['enquiry'];
        $this->enquiryTable->save($enquiry);

        $message = [0 => 'User enquiry answered.'];
        header('refresh: 4; url=/admin/enquiry');
        return [
            'template' => 'applyMessage.html.php',
            'variables' => ['message' => $message[0]],
            'title' => 'Jo\'s Jobs - Admin Enquiry'
        ];
    }

    public function answerEnquiryForm() {
        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {
            $enquiry = $this->enquiryTable->find('id', $_GET['id'])[0];
            
            return [
                'template' => 'admin/enquiryAnswer.html.php',
                'variables' => ['enquiry' => $enquiry],
                'title' => 'Jo\'s Jobs - Admin Enquiry'
            ];
        }
        else {
            header('location: /'); 
        }
    }

    public function deleteEnquiry() {
        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {

            $enquiry = $this->enquiryTable->delete($_GET['id']);

            header('location: /admin/enquiry');
        }
        else {
            header('location: /'); 
        }
    }
}