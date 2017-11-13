<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Language Settings
 *
 * @package    private
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */

// Loading language packages for displaying communiques:
require_once realpath( dirname(__FILE__).'/../core/classes/languages/load.php' );
require_once realpath( dirname(__FILE__).'/../core/classes/message/load.php' );

use \core\classes\languages\Lang;

// Setting dispaly language for all messages: 
Lang::setDisplayLanguage( EN );