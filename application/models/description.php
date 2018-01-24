<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Description extends DataMapper
{

	var $has_one = array('comic');
	var $has_many = array();
	var $validation = array(
		'comic_id' => array(
			'rules' => array('is_int', 'required', 'max_length' => 256),
			'label' => 'Comic ID',
			'type' => 'hidden'
		),
		'description' => array(
			'rules' => array(),
			'label' => 'Description'
		),
		'language' => array(
			'rules' => array('required'),
			'label' => 'Language',
			'type' => 'language'
		)
	);

	function __construct($id = NULL) {
		parent::__construct(NULL);
		// We've overwrote some functions, and we need to use the get() from THIS model
		if (!is_null($id)) {
			$this->where('id', $id)->get();
		}
	}


	function post_model_init($from_cache = FALSE)
	{

	}


	/**
	 * This function sets the translations for the validation values.
	 *
	 * @author Woxxy
	 * @return void
	 */
	function help_lang()
	{
		$this->validation['language']['label'] = _('Language');
		$this->validation['language']['help'] = _('Select the language of the chapter.');
		$this->validation['description']['label'] = _('Description');
	}

	/**
	 * Overwrites the original DataMapper to_array() to add some elements
	 *
	 * @param array $fields
	 * @return array
	 */
	public function to_array($fields = '') {
		$result = parent::to_array($fields = '');
		return $result;
	}

	/**
	 * Function to create a new entry for a chapter from scratch. It creates
	 * both a directory and a database entry, and removes them if something
	 * goes wrong.
	 *
	 * @author	Woxxy
	 * @param	array $data with the minimal values, or the function will return
	 * 			false and do nothing.
	 * @return	boolean true on success, false on failure.
	 */
	public function add($data)
	{
		// Check if comic_id is set and confirm there's a corresponding serie
		// If not, make an error message and stop adding the description
		$comic = new Comic($data['comic_id']);
		if ($comic->result_count() == 0)
		{
			set_notice('error', _('The series you were adding the description to doesn\'t exist.'));
			log_message('error', 'add: comic_id does not exist in comic database');
			return false;
		}

		// The series exists? Awesome, set it as soon as possible.
		$this->comic_id = $data['comic_id'];

		// Hoping we got enough $data, let's throw it to the database function.
		if (!$this->update_description_db($data))
		{
			$this->remove_description_dir();
			log_message('error', 'add: failed adding to database');
			return false;
		}

		// Oh, since we already have the series, let's put it into its variable.
		// This is very comfy for redirection!
		$this->comic = $comic;

		// All good? Return true!
		return true;
	}


	/**
	 * Removes chapter from database, all its pages, and its directory.
	 * There's no going back from this!
	 *
	 * @author	Woxxy
	 * @return	object the comic the chapter derives from.
	 */
	public function remove()
	{
		// Get series and check if existant. We don't want to have empty stub on this!
		$comic = new Comic($this->comic_id);
		if ($this->result_count() == 0)
		{
			set_notice('error', _('You\'re trying to delete something that doesn\'t even have a related series\'?'));
			log_message('error', 'remove_description: failed to find requested id');
			return false;
		}

		// Remove the chapter from DB, and all its pages too.
		if (!$this->remove_description_db())
		{
			log_message('error', 'remove_description: failed to delete database entry');
			return false;
		}

		// Return the $comic for redirects.
		return $comic;
	}


	/**
	 *
	 * @author	Woxxy
	 * @param	array $data contains the minimal data
	 * @return	object the series the description derives from.
	 */
	public function update_description_db($data = array())
	{
		// Check if we're updating or creating a new description by looking at $data["id"].
		// False is returned if the description ID was not found.
		if (isset($data["id"]) && $data['id'] != "")
		{
			$this->where("id", $data["id"])->get();
			if ($this->result_count() == 0)
			{
				set_notice('error', _('The description you tried to edit doesn\'t exist.'));
				log_message('error', 'update_description_db: failed to find requested id');
				return false;
			}
		}
		else
		{ // if we're here, it means that we're creating a new chapter
			// Set the creator name if it's a new chapter.
			if (!isset($this->comic_id))
			{
				set_notice('error', 'You didn\'t select a series to refer to.');
				log_message('error', 'update_description_db: comic_id was not set');
				return false;
			}

			// Check that the related series is defined, and exists.
			$comic = new Comic($this->comic_id);
			if ($comic->result_count() == 0)
			{
				set_notice('error', _('The series you were referring to doesn\'t exist.'));
				log_message('error', 'update_description_db: comic_id does not exist in comic database');
				return false;
			}
		}


		// Loop over the array and assign values to the variables.
		foreach ($data as $key => $value)
		{
			$this->$key = $value;
		}

		// Save with validation. Push false if fail, true if good.
		$success = $this->save();
		if (!$success)
		{
			if (!$this->valid)
			{
				log_message('error', $this->error->string);
				set_notice('error', _('Check that you have inputted all the required fields.'));
				log_message('error', 'update_description_db: failed validation');
			}
			else
			{
				set_notice('error', _('Failed to save to database for unknown reasons.'));
				log_message('error', 'update_description_db: failed to save');
			}
			return false;
		}
		else
		{
			// Here we go!
			return true;
		}
	}


	/**
	 * Removes the description from the database.
	 *
	 * @author	Woxxy
	 * @return	boolean true if success, false if failure.
	 */
	public function remove_description_db() {
		$success = $this->delete();
		if (!$success)
		{
			set_notice('error', _('Failed to remove the description from the database for unknown reasons.'));
			log_message('error', 'remove_description_db: id found but entry not removed');
			return false;
		}

		// It's gone.
		return true;
	}

}

/* End of file description.php */
/* Location: ./application/models/description.php */
