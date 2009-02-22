<?php

/**
 * Twitter library for simple twitter integration
 *
 * @author Matthew Wells (http://www.ninjapenguin.co.uk)
 **/
class Twitter_Core
{
	/*
	 * Username
	 * @var String
	 */
	private $username;
	
	/*
	 * Password
	 * @var String
	 */
	private $password;
	
	
	/** 
	 * Constructor
	 */
	public function __construct($username, $password)
	{
		$this->username = $username;
		
		$this->password = $password;
	}
	
	
	/**
	 * Get Status
	 * Get the latest 20 status updates
	 */
	public function get_status($format = 'json')
	{
		return Curl::get('http://twitter.com/statuses/user_timeline.'.$format, array(), false, array(CURLOPT_USERPWD => "$this->username:$this->password"));
	}
	
	
	/**
	 * Set Status 
	 * Sets the users status
	 * @param String	Status to set for user
	 * @param String	Id of message this status is a reply to 
	 * @param String	Format of success response
	 */
	public function set_status($status, $in_reply_to_id = null, $format = 'json')
	{
		//Set the correct headers
		$headers = array('Expect:');
		
		//Form the data
		$data = array('status' => $status);
		
		//If its a reply set the relevant data
		if($in_reply_to_id) $data['in_reply_to_status_id'] = $in_reply_to_status_id;
		
		return Curl::post('http://twitter.com/statuses/update.json', $data, $headers, false, array(CURLOPT_USERPWD => "$this->username:$this->password"));
	}
	
	
	/**
	 * Delete
	 * Delete a status
	 * @param String	The id of the status to delete
	 * @param String	The format of the response
	 */
	public function delete_status($id, $format = 'json')
	{
		//Set the correct headers
		$headers = array('Expect:');
		
		return Curl::post('http://twitter.com/statuses/destroy/'.$id.'.'.$format, array(), $headers, false, array(CURLOPT_USERPWD => "$this->username:$this->password"));
	}
	
	
	/**
	 * Get Replies
	 * Get the latest 20 replies for the user
	 * @param String	The format of the response
	 */
	public function get_replies($format = 'json')
	{
		return Curl::get('http://twitter.com/statuses/replies.'.$format, array(), false, array(CURLOPT_USERPWD => "$this->username:$this->password"));
	}
	
	
	/**
	 * Get user info
	 * Gets the user information
	 * @param String	The format of the response
	 */
	public function get_user_info($format = 'json')
	{
		return Curl::get("http://twitter.com/users/show/{$this->username}.{$format}", array(), false, array(CURLOPT_USERPWD => "$this->username:$this->password"));
	}
	
}

?>