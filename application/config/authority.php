<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Initialize User Permissions Based On Roles
	|--------------------------------------------------------------------------
	|
	| This closure is called by the Authority\Ability class' "initialize" method
	|
	*/

	'initialize' => function($user)
	{
		// If a user doesn't have any roles, we don't have to give him permissions so we can stop right here.
		if(count($user->roles) === 0) return false;

		if($user->has_role('admin'))
		{
			Authority::allow('skip', 'playlist_entry');
			Authority::allow('delete', 'playlist_entry');
			Authority::allow('control', 'playlist_playback');

			Authority::allow('create', 'event');

		}

		if($user->has_role('playlist_screener'))
		{
			Authority::allow('display', 'playlist_screen');
		}
		
		if($user->has_role('attendee'))
		{
			Authority::allow('submit', 'playlist_entry');
			Authority::allow('submit', 'shout');
			Authority::allow('vote_skip', 'playlist_entry');
		}
	}

);