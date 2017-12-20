<?php

// abstract person class
abstract class Person{

	protected $lastname = null;
	// weight in kgs
	protected $weight = null;
	// height in cm
	protected $height = null;

	/**
	 * Constructor
	 *
	 * @param string $lastname - person's last name 
	 * @param mixed $weight - person's weight [int | float]
	 * @param mixed $height - person's height [int | float]
	 */
	public function __construct($lastname, $weight, $height){

		// last name of person
		$this->lastName = $lastname;

		// weight in kilograms
		$this->weight = is_numeric($weight)?$weight:die("MUST BE A NUMBER! DENIED!");
		// height in centimeters
		$this->height = is_numeric($height)?$height:die("WTF? NUMBERS ONLY!");

	}

	/**
	 * 
	 * Display the person string (or return it)
	 * 
	 * @param type $return - (false) Do we want the person string returned, or not
	 * @return $this - The person object 
	 */
	public function display($return = false){

		$hs = $ws = "s";

		// first name comes from subclass
		// both first and last name get the first letter uppercased
		$firstName = ucfirst(get_class($this));
		$lastName = ucfirst($this->lastName);

		// check for singulars
		if(abs($this->weight) === 1){
			$ws = "";
		}
		if(abs($this->height) === 1){
			$hs = "";
		}

		// make the person string
		$string = "My name is {$firstName} {$lastName}. I weigh {$this->weight}kg{$ws}, and am {$this->height}cm{$hs} tall.";

		if($return){
			// return the string if asked to do so
			return $string;
		}

		// otherwise, continue echoing, and return the object's self
		echo $string;

		return $this;

	}

	/**
	 *
	 * Make the person 'say' some things
	 *
	 * @param string $words - some words
	 * @return $this - The person
	 */
	public function say($words){

		// say some things
		echo $words;
		return $this;
	}


}

