<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Functions
 *
 */

/**
 * Function validatePassword
 *
 * if password-min-length is set in settings
 * we check against the length, if not matched
 * an error message will be output and 'exit' is called
 *
 * @param string $password the password to validate
 *
 * @return string either the password or an errormessage+exit
 */
function validatePassword($password = null) {
	
	if (Settings::Get('panel.password_min_length') > 0) {
		$password = validate(
			$password, 
			Settings::Get('panel.password_min_length'),
			'/^.{'.(int)Settings::Get('panel.password_min_length').',}$/D',
			'notrequiredpasswordlength'
		);
	}
	
	if (Settings::Get('panel.password_regex') != '') {
		$password = validate(
			$password, 
			Settings::Get('panel.password_regex'),
			Settings::Get('panel.password_regex'),
			'notrequiredpasswordcomplexity'
		);
	}
	
	return $password;
}
