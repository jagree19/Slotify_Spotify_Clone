<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($un, $pw) {
			$pw = md5($pw);

			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

			if(mysqli_num_rows($query) == 1) {
				return true;
			} else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		public function register($username, $firstName, $lastName, $email, $email2, $password, $password2) {
			$this->validateUsername($username);
			$this->validateFirstname($firstName);
			$this->validateLastname($lastName);
			$this->validateEmails($email, $email2);
			$this->validatePasswords($password, $password2);

			if(empty($this->errorArray)) {
				//Insert into db
				return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
			} else {
				return false;
			}

		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw) {
			$encryptedPw = md5($pw); // encrypts password using md5
			$profilePic = "assets/images/profile-pics/74903534-a-cute-cartoon-wizard-mascot-character-pointing-.jpg";
			$date = date("Y-m-d");

			$result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
			return $result;
		}

		private function validateUsername($username) {
			
			if(strlen($username) > 25 || strlen($username) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			} 

			//TODO: check if username exists
			$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username'");
			if(mysqli_num_rows($checkUsernameQuery) != 0) {
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}


		}

		private function validateFirstname($firstName) {

			if(strlen($firstName) > 25 || strlen($firstName) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}

		}

		private function validateLastname($lastName) {

			if(strlen($lastName) > 25 || strlen($lastName) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}

		}

		private function validateEmails($email, $email2) {

			if($email != $email2) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
				return;
			}

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return;
			}

			//TODO: check email has not been used
			$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$email'");
			if(mysqli_num_rows($checkEmailQuery) !=0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return;
			}

		}

		private function validatePasswords($password, $password2) {

			if($password != $password2) {
				array_push($this->errorArray, Constants::$passwordsDoNotMatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $password)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}

			if(strlen($password) > 30 || strlen($password) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			} 

		}

	}
?>