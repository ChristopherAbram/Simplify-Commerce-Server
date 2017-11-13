<?php

require_once realpath( dirname(__FILE__).'/lib/Simplify.php' );

// Set API keys:
Simplify::$publicKey = API_PUBLIC_KEY;
Simplify::$privateKey = API_PRIVATE_KEY;