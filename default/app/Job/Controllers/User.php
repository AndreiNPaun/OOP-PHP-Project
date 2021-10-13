<?php
namespace Job\Controllers;

class User {
    private $usersTable;

    public function __construct($usersTable) {
        $this->usersTable = $usersTable;
    }

    public function registerSubmit() {
        
        $user = $_POST['user'];
            
        //Form cannot be submited if fields are empty
        if ($user['username'] !== '' && $user['email'] !=='' && $user['password'] !== '') {
            
            //Check if the submited email is of format email@email.com and if not redirect back to register page
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $message = [0 => 'Invalid email, redirecting to register page.'];
                return [
                    'template' => 'applyMessage.html.php',
                    'variables' => ['message' => $message[0]],
                    'title' => 'Jo\'s Jobs - Register'
                ];
                header('refresh: 3; url = register');       
            }
            else {       
                //Password hashing for additional protection on accounts
                $hash = password_hash($user['password'], PASSWORD_DEFAULT);
                $user['password'] = $hash;
                
                $this->usersTable->save($user);

                //After successfuly registering, user will be taken to login page
                $message = [0 => 'Account created.'];

                header('refresh: 3; url = login');

                return [
                    'template' => 'applyMessage.html.php',
                    'variables' => ['message' => $message[0]],
                    'title' => 'Jo\'s Jobs - Register'
                ];
            }
        }
            //Error message in case fields are not completed
        else {
            $message = [0 => 'All fields must be completed.'];
            return [
                'template' => 'applyMessage.html.php',
                'variables' => ['message' => $message[0]],
                'title' => 'Jo\'s Jobs - Register'
            ];
            header('refresh: 3; url = register');
        }
    }

    public function registerForm() {

        if (!isset($_SESSION['loggedin'])){
            return [
                'template' => 'register.html.php',
                'title' => 'Jo\'s Jobs - Register',
                'variables' => []
            ];
        }

        //if User is already logged in, redirect to homepage
        else{
            header('location: /');
        }
    }

    public function loginSubmit() {

        $login = $_POST['user'];

        if ($login['username'] !== '' && $login['password'] !== '') {
            //DB query to find out if the user trying to log in actually exists
            $user = $this->usersTable->find('username', $login['username'])[0];

            //Log in validation related to the query above
            if ($user['username'] === $login['username']) {
                    
                //Heads back to index.php after the log in has been successful
                if (password_verify($login['password'], $user['password'])) {
                    $_SESSION['loggedin'] = $user['id'];
                    $_SESSION['user_type'] = $user['user_type'];
                    $_SESSION['username'] = $user['username'];
                        
                    if ($_SESSION['user_type'] === 'admin'|| $_SESSION['user_type'] === 'staff' || $_SESSION['user_type'] === 'client') {
                        header('location: /admin/home');
                    }
                    else {
                        header('location: /');
                    }
                }
                else{
                    $message = [0 => 'Incorrect details, please try again.'];
                    return [
                        'template' => 'applyMessage.html.php',
                        'variables' => ['message' => $message[0]],
                        'title' => 'Jo\'s Jobs - Login'
                    ];
                    header('refresh: 3; url= /login');
                }
            }
            //If fields are empty or details are incorrect, refresh page
            else{
                $message = [0 => 'Incorrect details, please try again.'];
                return [
                    'template' => 'applyMessage.html.php',
                    'variables' => ['message' => $message[0]],
                    'title' => 'Jo\'s Jobs - Login'
                ];
                header('refresh: 3; url= /login');
            }      
        }

        else {
            $message = [0 => 'Fields must be completed.'];
            return [
                'template' => 'applyMessage.html.php',
                'variables' => ['message' => $message[0]],
                'title' => 'Jo\'s Jobs - Login'
            ];
            header('refresh: 3; url= /login');
        }  
    }

    public function loginForm() {
        if (!isset($_SESSION['loggedin'])){

            return [
			    'template' => 'login.html.php',
			    'variables' => [],
			    'title' => 'Jo\'s Jobs - Login'
            ];
        }

        else {
            header('location: /');
        }
    }

    public function logout() {
        //Unsets session ID for user, making logout possible.
        unset($_SESSION['loggedin']);
        unset($_SESSION['user_type']);

        //Heads back to login after user successfully logged out.
        header('location: /login');
    }

    public function adminHome() {
        return [
            'template' => 'admin/home.html.php',
            'variables' => [],
            'title' => 'Jo\'s Jobs - Admin'
        ];
    }

    public function userList() {
        if ($_SESSION['user_type'] === 'admin') {
            $user = $this->usersTable->findAll();

            return [
                'template' => 'admin/userList.html.php',
                'variables' => ['user' => $user],
                'title' => 'Jo\'s Jobs - Users'
            ];
        }
        else {
            header('location: /');
        }
    }

    public function userTypeSubmit() {
		$this->usersTable->save($_POST['user']);
		header('location: /admin/users');
	}

	public function userTypeForm() {
        if ($_SESSION['user_type'] === 'admin'){
            $user = $this->usersTable->find('id', $_GET['id'])[0];

            return [
                'template' => 'admin/edituser.html.php',
                'variables' => ['user' => $user],
                'title' => 'Jo\'s Jobs - Edit User'
            ];
        }
        else {
            header('location: /');
        }
    }
    
    public function deleteUser() {
        if ($_SESSION['user_type'] === 'admin') {
            $user = $_POST['id'];
            $this->usersTable->delete($user);

            header('location: /admin/users');
        }
        else {
            header('location: /');
        }
	}
}