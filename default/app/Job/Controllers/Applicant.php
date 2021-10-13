<?php
namespace Job\Controllers;

class Applicant {
    private $applicantsTable;
    private $jobsTable;
    private $usersTable;

    public function __construct($applicantsTable, $jobsTable, $usersTable) {
        $this->applicantsTable = $applicantsTable;
        $this->jobsTable = $jobsTable;
        $this->usersTable = $usersTable;
    }

    public function applySubmit() {
        $applicant = $_POST['applicant'];
	
        if ($applicant['name'] !== '' && $applicant['email'] !== ''){

            if ($_FILES['cv']['error'] == 0) {

                $parts = explode('.', $_FILES['cv']['name']);
    
                $extension = end($parts);
    
                $fileName = uniqid() . '.' . $extension;
    
                $fileExt = strtolower($extension);
                $checkExt = ['pdf', 'docx', 'doc', 'odt'];
    
                if (in_array($fileExt, $checkExt)) {
                        
                    if (!filter_var($applicant['email'], FILTER_VALIDATE_EMAIL)) {
                            $message = [0 => 'Wrong email address format.'];
                            header('refresh: 4: url = /');
                            return [
                                'template' => 'applyMessage.html.php',
                                'variables' => ['message' => $message[0]],
                                'title' => 'Jo\'s Jobs - Apply'
                            ];
                    }
                    else {
                        move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);
                        $applicant['cv'] = $fileName;

                        $this->applicantsTable->save($applicant);

                        $message = [0 => 'Your application is complete. We will contact you after the closing date.'];
                        header('refresh: 4; url = /');
                        return [
                            'template' => 'applyMessage.html.php',
                            'variables' => ['message' => $message[0]],
                            'title' => 'Jo\'s Jobs - Apply'
                        ];
                        }
                    }
                else {
                    header('refresh: 4; url = /');
                    $message = [0 => 'Wrong CV format. Only acceptable formats are: Microsoft Word (.doc and .docx), 
                                    OpenOffice Writer document (.odt) andPDF (.pdf).'];
                    return [
                        'template' => 'applyMessage.html.php',
                        'variables' => ['message' => $message[0]],
                        'title' => 'Jo\'s Jobs - Apply'
                    ];
                }
            }
            else {
                $message = [0 => 'There was an error uploading your CV'];
                header('refresh: 4; url = /');
                return [
                    'template' => 'applyMessage.html.php',
                    'variables' => ['message' => $message[0]],
                    'title' => 'Jo\'s Jobs - Apply'
                ];
            }
        }
        else {
            if (isset($_GET['id'])){
                $message = [0 => 'All field with star (*) must be completed.'];
                header('refresh: 4; url = /');
                return [
                    'template' => 'applyMessage.html.php',
                    'variables' => ['message' => $message[0]],
                    'title' => 'Jo\'s Jobs - Apply'
                ];
                }
                else {
                    header('location: /');
                }
            }
    }

    public function applyForm() {
        if (isset($_GET['id'])) {

            $job = $this->jobsTable->find('id', $_GET['id'])[0];
            $user = $this->usersTable->find('id', $_SESSION['loggedin'])[0];
            return [
                'template' => 'apply.html.php',
                'variables' => ['job' => $job, 'user' => $user],
                'title' => 'Jo\'s Jobs - Apply'
            ];
        }
        else {
            header('location: /');
        }
    }

    public function applicantsList() {

            $applicants = $this->applicantsTable->find('jobId', $_GET['id']);
            $job = $this->jobsTable->find('id', $_GET['id'])[0];

            return [
                'template' => 'admin/applicants.html.php',
                'variables' => ['applicants' => $applicants, 'job' => $job],
                'title' => 'Jo\'s Jobs - Applicants'
            ];
    }
}