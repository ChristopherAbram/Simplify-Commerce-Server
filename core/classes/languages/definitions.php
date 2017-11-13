<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Definitions for Languages package.
 *
 * @package    core\classes\languages
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.09.2015
 */
 
// Defines key representing global namespace:
define( '__GLOBAL__', 'GLOBAL' );

// Defines type id for messages describing correctly executed operation:
define( 'CORRECT', 0 );

// Defines type id for messages describing situations which were executed correctly, but the were some inaccuracies:
define( 'WARNING', 1 );

// Defines type id for messages describing error occurrances:
define( 'ERROR', 2 );

// Defines type id for plain text which is not connected with any communiques:
define( 'TEXT', 3 );

// Defines language ids:
define( 'EN', 'en' );
define( 'PL', 'pl' );
// ...