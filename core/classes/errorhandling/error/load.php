<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Load Error package
 *
 * @package    core\classes\errorhandling\error
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.07.2015
 */
 
require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath(dirname(__FILE__).'/Error.php');

require_once realpath(dirname(__FILE__).'/FatalErrorException.php');
require_once realpath(dirname(__FILE__).'/WarningException.php');
require_once realpath(dirname(__FILE__).'/ParseException.php');
require_once realpath(dirname(__FILE__).'/NoticeException.php');
require_once realpath(dirname(__FILE__).'/CoreErrorException.php');
require_once realpath(dirname(__FILE__).'/CoreWarningException.php');
require_once realpath(dirname(__FILE__).'/CompileErrorException.php');
require_once realpath(dirname(__FILE__).'/CompileWarningException.php');
require_once realpath(dirname(__FILE__).'/UserErrorException.php');
require_once realpath(dirname(__FILE__).'/UserWarningException.php');
require_once realpath(dirname(__FILE__).'/UserNoticeException.php');
require_once realpath(dirname(__FILE__).'/StrictException.php');
require_once realpath(dirname(__FILE__).'/RecoverableErrorException.php');
require_once realpath(dirname(__FILE__).'/DeprecatedException.php');
require_once realpath(dirname(__FILE__).'/UserDeprecatedException.php');