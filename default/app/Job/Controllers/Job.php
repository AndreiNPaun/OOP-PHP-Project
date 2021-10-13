<?php
namespace Job\Controllers;
class Job {
	private $jobDB;
	private  $jobsTable;
	private $categoriesTable;

    public function __construct($jobDB,  $jobsTable, $categoriesTable) {
		$this->jobDB = $jobDB;
		$this->jobsTable = $jobsTable;
		$this->categoriesTable = $categoriesTable;
	}
	
	public function home() {
		$jobs = $this->jobDB->homeList();

		return [
			'template' => 'home.html.php',
			'variables' => ['jobs' => $jobs],
			'title' => 'Jo\'s Jobs - Home'
		];
    }

	public function listJobs() {

		$jobs = $this->jobDB->findBy('categoryId', $_GET['id']);
		$title = $this->categoriesTable->find('id', $_GET['id'])[0];

		return [
			'template' => 'joblist.html.php',
			'variables' => ['jobs' => $jobs, 'title' => $title],
			'title' => 'Jo\'s Jobs - Sales Jobs'
		];
	}

	public function jobAdmin() {
		if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client') {
			
			$jobs = $this->jobsTable->findAll();

			return [
				'template' => 'admin/jobs.html.php',
				'variables' => ['jobs' => $jobs],
				'title' => 'Jo\'s Jobs - Jobs Admin'
			];
		}		
		else {
			header('location: /');
		}		
	}
	

	public function editJobSubmit() {
		$job = $_POST['job'];

		if ($job['title'] !== '' && $job['description'] !== '' && $job['location'] !== '' && $job['salary'] !== ''){

			$this->jobsTable->save($job);
			//$this->jobDB->categoryName($job['categoryId']);
			header('location: /admin/jobs');
		}

		else {
			$message = [0 => 'Empty fields, please try again.'];
			header('refresh: 4; url=/admin/editjob');
			return [
				'template' => 'admin/addMessage.html.php',
				'variables' => ['message' => $message[0]],
				'title' => 'Jo\'s Jobs - Edit Job'
			];
		}
	}

	public function editJobForm() {
		if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client') {

			$category = $this->categoriesTable->findAll();

			if (isset($_GET['id'])) {
				$record = $this->jobsTable->find('id', $_GET['id'])[0];
			}
			else {
				$record = false;
			}

			return [
				'template' => 'admin/editjob.html.php',
				'variables' => ['category' => $category, 'record' => $record],
				'title' => 'Jo\'s Jobs - Edit Job'
			];
		}

		else {
			header('location: /');
		}
	}

	public function deleteJob() {
        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client') {

            $job = $_POST['id'];
    
            $this->jobsTable->delete($job);
        
            header('location: /admin/jobs');
    
        }
    
        else {
            header('location: /');
		}
	}
}