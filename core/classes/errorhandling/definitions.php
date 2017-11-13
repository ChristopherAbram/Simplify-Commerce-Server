<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Definitions for ErrorHandling package.
 *
 * @package    core\classes\errorhandling
 * @author     Christopher Abram
 * @version    1.0
 * @date	06.09.2015
 */
 
// Constans for error exceptions displaying:
define( 'ERRNUM', 0x01 );  // error number
define( 'ERRTIT', 0x02 );  // error title
define( 'ERRMSG', 0x04 );  // error message
define( 'ERRLOC', 0x08 );  // error location
define( 'ERRSEV', 0x10 );  // error severity
define( 'ERRTRC', 0x20 );  // error backtrace
define( 'ERRCOD', 0x40 );  // error code
define( 'ERRCNX', 0x80 );  // error context
define( 'ERRALL', 0xFF );  // all errors

// constans for php.ini errors:
define( 'ERROR_REPORTING', 			'error_reporting' );
define( 'DISPLAY_ERRORS', 			0x0001 );
define( 'DISPLAY_STARTUP_ERRORS', 	0x0002 );
define( 'LOG_ERRORS', 				0x0004 );
define( 'IGNORE_REPEATED_ERRORS', 	0x0008 );
define( 'IGNORE_REPEATED_SOURCE', 	0x0010 );
define( 'REPORT_MEMLEAKS', 			0x0020 );
define( 'TRACK_ERRORS', 			0x0040 );
define( 'HTML_ERRORS', 				0x0080 );
define( 'XMLRPC_ERRORS', 			0x0100 );
define( 'LOG_ERRORS_MAX_LEN', 		'log_errors_max_len' );
define( 'XMLRPC_ERRORS_NUMBER', 	'xmlrpc_error_number' );
define( 'DOCREF_ROOT', 				'docref_root' );
define( 'DOCREF_EXT', 				'docref_ext' );
define( 'ERROR_PREPEND_STRING', 	'error_prepend_string' );
define( 'ERROR_APPEND_STRING', 		'error_append_string' );
define( 'ERROR_LOG', 				'error_log' );