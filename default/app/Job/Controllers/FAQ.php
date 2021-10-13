<?php
namespace Job\Controllers;
class FAQ {
    private $faqsTable;
    private $usersTable;
    private $enquiryTable;

    public function __construct($faqsTable, $usersTable, $enquiryTable) {
        $this->faqsTable = $faqsTable;
        $this->usersTable = $usersTable;
        $this->enquiryTable = $enquiryTable;
    }

    public function faqsSubmit() {
        $enquiry = $_POST['enquiry'];

        if ($enquiry['name'] !== '' && $enquiry['email'] !== '' && $enquiry['phone'] !== '' && $enquiry['description'] !== '') {
            $this->enquiryTable->save($enquiry);

            $message = [0 => 'Enquiry submited, a member of the staff will contact you shortly with an answer.'];
            header('refresh: 4; url=/');
            return [
                'template' => 'applyMessage.html.php',
                'variables' => ['message' => $message[0]],
                'title' => 'Jo\'s Jobs - FAQs'
            ];
        }

        else {
            $message = [0 => 'Please fill all form fields.'];
            header('refresh: 4; url= /faqs');
            return [
                'template' => 'applyMessage.html.php',
                'variables' => ['message' => $message[0]],
                'title' => 'Jo\'s Jobs - FAQs'
            ];
        }

    }

    public function faqsForm() {
        $faq = $this->faqsTable->findAll();
        if (isset($_SESSION['loggedin'])) {
            $user = $this->usersTable->find('id', $_SESSION['loggedin'])[0];

            return [
                'template' => 'faqs.html.php',
                'variables' => ['faq' => $faq, 'user' => $user],
                'title' => 'Jo\'s Jobs - FAQS'
            ];
        }

        else {
            return [
                'template' => 'faqs.html.php',
                'variables' => ['faq' => $faq],
                'title' => 'Jo\'s Jobs - FAQS'
            ];
        }
    }
}