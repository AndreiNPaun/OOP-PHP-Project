<?php
namespace Job;

class Routes implements \CSY2028\Routes {
	
	public function getRoutes() {
		require '../app/database.php';

		//Database instances
		$jobsTable = new \CSY2028\DatabaseTable($pdo, 'job', 'id');
		$categoriesTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');
		$faqsTable = new \CSY2028\DatabaseTable($pdo, 'faq', 'id');
		$usersTable = new \CSY2028\DatabaseTable($pdo, 'user', 'id');
		$applicantsTable = new \CSY2028\DatabaseTable($pdo, 'applicants', 'id');
		$enquiryTable = new \CSY2028\DatabaseTable($pdo, 'enquiry', 'id');

		//DB with special functions for the Jobs website
		$jobDB = new \Job\Database\JobDB($pdo, 'job');

		//Controllers
		$jobsController = new \Job\Controllers\Job($jobDB, $jobsTable, $categoriesTable);
		$categoriesController = new \Job\Controllers\Category($categoriesTable, $enquiryTable);
		$faqController = new \Job\Controllers\FAQ($faqsTable, $usersTable, $enquiryTable);
		$userController = new \Job\Controllers\User($usersTable);
		$applicantsController = new \Job\Controllers\Applicant($applicantsTable, $jobsTable, $usersTable);
		$enquiryController = new \Job\Controllers\Enquiry($enquiryTable, $usersTable);

		//Website routes
		$routes = [
			'' => [
				'GET' => [
					'controller' => $jobsController,
					'function' => 'home'
				]
			],
			'category' => [
				'GET' => [
					'controller' => $jobsController,
					'function' => 'listJobs'
				]
			],

			'faqs' => [
				'GET' => [
					'controller' => $faqController,
					'function' => 'faqsForm'
				],
				'POST' => [
					'controller' => $faqController,
					'function' => 'faqsSubmit'
				]
			],
			'register' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'registerForm'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'registerSubmit'
				]
			],
			'login' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'loginForm'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'loginSubmit'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'logout'
				]
			],
			'apply' => [
				'GET' => [
					'controller' => $applicantsController,
					'function' => 'applyForm'
				],
				'POST' => [
					'controller' => $applicantsController,
					'function' => 'applySubmit'
				]
			],
			'admin/home' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'adminHome'
				],
				'login' => true
			],
			'admin/jobs' => [
				'GET' => [
					'controller' => $jobsController,
					'function' => 'jobAdmin'
				],
				'login' => true
			],
			'admin/categories' => [
				'GET' => [
					'controller' => $categoriesController,
					'function' => 'categoryAdmin'
				],
				'login' => true
			],
			'admin/editjob' => [
				'GET' => [
					'controller' => $jobsController,
					'function' => 'editJobForm'
				],
				'POST' => [
					'controller' => $jobsController,
					'function' => 'editJobSubmit'
				],
				'login' => true
			],
			'admin/deletejob' => [
				'POST' => [
					'controller' => $jobsController,
					'function' => 'deleteJob'
				],
				'login' => true
			],
			'admin/editcategory' => [
				'GET' => [
					'controller' => $categoriesController,
					'function' => 'editCatForm'
				],
				'POST' => [
					'controller' => $categoriesController,
					'function' => 'editCatSubmit'
				],
				'login' => true
			],
			'admin/deletecategory' => [
				'POST' => [
					'controller' => $categoriesController,
					'function' => 'deleteCat'
				],
				'login' => true
			],
			'admin/applicants' => [
				'GET' => [
					'controller' => $applicantsController,
					'function' => 'applicantsList'
				],
				'login' => true
			],
			'admin/users' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'userList'
				],
				'login' => true
			],
			'admin/edituser' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'userTypeForm'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'userTypeSubmit'
				],
				'login' => true
			],
			'admin/deleteuser' => [
				'POST' => [
					'controller' => $userController,
					'function' => 'deleteUser'
				],
				'login' => true
			],
			'admin/enquiry' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'enquiry'
				],
				'login' => true
			],
			'admin/answerenquiry' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'answerEnquiryForm'
				],
				'POST' => [
					'controller' => $enquiryController,
					'function' => 'answerEnquirySubmit'
				],
				'login' => true
			],
			'admin/archieve' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'archieve'
				],
				'login' => true
			],
			'admin/deleteenquiry' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'deleteEnquiry'
				],
				'login' => true
			],
		];

		return $routes;
	}

	public function checkLogin() {
		//session_start();
		if(!isset($_SESSION['loggedin'])) {
			header('location: /');
		}
	}
}