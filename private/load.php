<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Load PRIVATE files
 *
 * @package    private
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */
 
// Loading private server settings for default encoding:
//require_once realpath(dirname(__FILE__).'/timezone_settings.php');
// Loading private server settings for default date timezone:
require_once realpath(dirname(__FILE__).'/timezone_settings.php');
// Loading private server settings for display language:
require_once realpath(dirname(__FILE__).'/language_settings.php');
// Loading private server settings for error handling:
require_once realpath(dirname(__FILE__).'/error_settings.php');
require_once realpath(dirname(__FILE__).'/simplify.php');