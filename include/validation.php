<?php
include('load.php');
	class validation {

	public function valid($variables) {
		$message = '';
		foreach($variables as $key => $value) {
			switch ($key) {
				case 'nume':
					$name = $this->emptyText($value);
					$validationText = $this->validationText($value);
					if($name == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					} else if ($validationText == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate avea cifre.</div>';
					}
					break;
				case 'telefon':
					$telefon = $this->emptyText($value);
					$telefonFormat = $this->validationPhone($value); 
					if($telefon == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					} else if ($telefonFormat == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' trebuie sa fie intr-un format valid.</div>';
					}
					break;
				case 'data':
					$data = $this->emptyText($value);
					if($data == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					}
					break;
				case 'ora':
					$ora = $this->emptyText($value);
					if($ora == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					}
					break;
				case 'doctor':
					$name = $this->emptyText($value);
					$validationText = $this->validationText($value);
					if($name == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					} else if ($validationText == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate avea cifre.</div>';
					}
					break;
				case 'email':
					$email = $this->emptyText($value);
					if($email == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					}
					break;
				case 'user':
					$user = $this->emptyText($value);
					if($user == true) {
						$message .= '<div id="error' .$key .'" >Campul ' . $key . ' nu poate fi gol.</div>';
					}
					break;
				default:
					$message;
					break;
			}
		}
		return $message;

	}
	private static function emptyText( $input ) {
				 if(trim($input) == ''){
				 		return true;
				 }
				 return false;
	}

	private static function validationText( $input ) {
				 if(!empty(preg_match('/(\d)/', $input))){
				 		return true;
				 }
				 return false;
	}

	private static function validationPhone( $input ) {
				switch ($input) {
					case (!empty(preg_match('/^\+[0-9]{3}-[0-9]{4}-[0-9]{4}$/', $input))) :
						return false;
						break;
					case (!empty(preg_match('/^[0-9]{4}-[0-9]{3}-[0-9]{3}$/', $input))) :
						return false;
						break;
					case (!empty(preg_match('/^[0-9]{4}.[0-9]{3}.[0-9]{3}$/', $input))) :
						return false;
						break;
					case (!empty(preg_match('/^\+[0-9]{2}-[0-9]{3}.[0-9]{3}.[0-9]{3}$/', $input))) :
						return false;
						break;
					case (!empty(preg_match('/^\+[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{3}$/', $input))) :
						return false;
						break;	
					case (!empty(preg_match('/^[0-9]{4}\/[0-9]{3}\/[0-9]{3}$/', $input))) :
						return false;
						break;
					case (!empty(preg_match('/^[0-9]{4}\s[0-9]{3}\s[0-9]{3}$/', $input))) :
						return false;
						break;	
					case (!empty(preg_match('/^[\d\s]{2,}$/', $input))) :
						return false;	
						break;				
					default:
						return true;
				}
	}
	}
?>