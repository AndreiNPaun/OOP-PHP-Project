<?php
namespace Job\Controllers;
class Category {
    private $categoriesTable;
    private $enquiryTable;

    public function __construct($categoriesTable, $enquiryTable) {
        $this->categoriesTable = $categoriesTable;
        $this->enquiryTable = $enquiryTable;
    }

    public function categoryAdmin() {
        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'staff') {
            $categories = $this->categoriesTable->findAll();
            return [
                'template' => 'admin/categories.html.php',
                'variables' => ['categories' => $categories],
                'title' => 'Jo\'s Jobs - Categories Admin'
            ];
        }
        else {
            header('location: /');
        }
    }

    public function editCatSubmit() {
        $category = $_POST['category'];
        if ($category['name'] !== '') {
            
		    $this->categoriesTable->save($category);
            header('location: /admin/categories');
        }

        else {
			$message = [0 => 'Empty fields, please try again.'];
			header('refresh: 4; url=/admin/editcategory');
			return [
				'template' => 'admin/addMessage.html.php',
				'variables' => ['message' => $message[0]],
				'title' => 'Jo\'s Jobs - Edit Job'
			];
		}
	}

	public function editCatForm() {
		if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff' ||  $_SESSION['user_type'] === 'client') {

			if (isset($_GET['id'])) {
				$record = $this->categoriesTable->find('id', $_GET['id'])[0];
			}
			else {
				$record = false;
			}

			return [
				'template' => 'admin/editcategory.html.php',
				'variables' => ['record' => $record],
				'title' => 'Jo\'s Jobs - Edit Job'
			];
		}

		else {
			header('location: /');
		}
    }
    
    public function deleteCat() {
        if ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'staff') {

            $category = $_POST['id'];
    
            $this->categoriesTable->delete($category);
        
            header('location: /admin/categories');
    
        }
    
        else {
            header('location: category.php');
        }
    }
}