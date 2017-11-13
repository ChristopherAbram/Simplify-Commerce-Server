<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Polish messages storage.
 *
 * @package    core\classes\errorhandling\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	05.09.2015
 */
 
namespace core\classes\errorhandling\error;

class Text extends \Text {
    
    protected static $_message = array(
        // Errors title:
	'title'			=> array(
            E_ERROR			=> 'Krytyczny błąd działania',
            E_WARNING			=> 'Ostrzeżenie podczas działania',
            E_PARSE			=> 'Krytyczny błąd parsowania',
            E_NOTICE			=> 'Spostrzeżenie podczas działania',
            E_CORE_ERROR		=> 'Krytyczny błąd inicjacji rdzenia PHP',
            E_CORE_WARNING		=> 'Ostrzeżenie inicjacji rdzenia PHP',
            E_COMPILE_ERROR		=> 'Krytyczny błąd kompilacji',
            E_COMPILE_WARNING           => 'Ostrzeżenie podczas kompilacji',
            E_USER_ERROR		=> 'Błąd wygenerowany przez użytkownika',
            E_USER_WARNING		=> 'Ostrzeżenie wygenerowane przez użytkownika',
            E_USER_NOTICE		=> 'Sposrzeżenie wygenerowane przez użytkownika',
            E_STRICT			=> 'Sugestia',
            E_RECOVERABLE_ERROR         => 'Krytyczny błąd zwrotny',
            E_DEPRECATED		=> 'Spostrzeżenie przestarzałego kodu',
            E_USER_DEPRECATED           => 'Spostrzeżenie użytkownika o przestarzałych zastosowaniach',
            E_ALL			=> 'Wszystkie błędy',
	),
	
	// Errors description:
	'description'	=> array(
            E_ERROR			=> 'Ten błąd wskazuje sytuacje, w których przywrócenie działania w dalszym ciągu jest niemożliwe. Wykonanie skryptu jest zatrzymane. Np. problem alokacji pamięci.',
            E_WARNING			=> 'Ostrzeżenia podczas działania wskazują błędy popełnione w kodzie przez programistów, które nie powodują zatrzymania wykonywania skryptu. Np. wskazanie błędnej ścieżki dołączenia pliku.',
            E_PARSE			=> 'Błąd parsowania generowany jest tylko przez parser. Np. brak średnika na końcu linii.',
            E_NOTICE			=> 'Spostrzeżenia wskazują, że skrypt napotkał coś, co może spowodować błąd. Mogą wystąpić podczas normalnego działania skryptu. Np. brak indeksu w tablicy.',
            E_CORE_ERROR		=> 'Krytyczny błąd inicjacji rdzenia PHP generowany jest przez rdzeń.',
            E_CORE_WARNING		=> 'Ostrzeżenie inicjacji rdzenia PHP generowane jest przez rdzeń.',
            E_COMPILE_ERROR		=> 'Błąd jest generowany przez Zend Scripting Engine.',
            E_COMPILE_WARNING           => 'Ostrzeżenie generowane jest przez Zend Scripting Engine.',
            E_USER_ERROR		=> 'Błąd ten generowany jest za pomocą funkcji trigger_error().',
            E_USER_WARNING		=> 'Ostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
            E_USER_NOTICE		=> 'Spostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
            E_STRICT			=> 'Umożliwia włączenie sugestii języka PHP, które opisują jakie zmiany można zaprowadzić w kodzie, aby zapewnić najlepszą interoperacyjność oraz wsteczną zgodność.',
            E_RECOVERABLE_ERROR         => 'Zdolne do złapania (przez klauzulę "catch") krytyczne błędy. Wskazują że, wystąpił prawdopodobnie niebezpieczny błąd, który nie opuścił rdzenia w niestabilnym stanie. Jeśli błąd nie jest złapany przez zdefiniowaną przez użytkownika funkcję (patrz: set_error_handler()), aplikacja kończy działanie tak, jakby wystąpił błąd krytyczny (E_ERROR).',
            E_DEPRECATED		=> 'Spostrzeżenia występujące podczas działania programu. Umożliwiają otrzymywanie uwag dotyczących kodu, który może nie działać w przyszłych wersjach.',
            E_USER_DEPRECATED           => 'Spostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
            E_ALL			=> 'Wszystkie błędy, ostrzeżenia, spostrzeżenia poza poziomem E_STRICT',
	),
	
	// Errors designation:
	'type'			=> array(
            E_ERROR			=> 'E_ERROR',
            E_WARNING		=> 'E_WARNING',
            E_PARSE			=> 'E_PARSE',
            E_NOTICE		=> 'E_NOTICE',
            E_CORE_ERROR		=> 'E_CORE_ERROR',
            E_CORE_WARNING		=> 'E_CORE_WARNING',
            E_COMPILE_ERROR		=> 'E_COMPILE_ERROR',
            E_COMPILE_WARNING	=> 'E_COMPILE_WARNING',
            E_USER_ERROR		=> 'E_USER_ERROR',
            E_USER_WARNING		=> 'E_USER_WARNING',
            E_USER_NOTICE		=> 'E_USER_NOTICE',
            E_STRICT		=> 'E_STRICT',
            E_RECOVERABLE_ERROR     => 'E_RECOVERABLE_ERROR',
            E_DEPRECATED		=> 'E_DEPRECATED',
            E_USER_DEPRECATED	=> 'E_USER_DEPRECATED',
            E_ALL			=> 'E_ALL',
	),
	
	// Errors header:
	'header'		=> array(
            'errloc'		=> 'Lokalizacja',
            'errcnx'		=> 'Kontekst wystąpienia błędu',
            'errcod'		=> 'Kod błędu',
            'errmsg'		=> 'Wiadomość',
            'errtrc'		=> 'Ślad wywołań stosu',
            'errtim'		=> 'Czas wygenerowania błędu',
            'errnum'		=> 'Numer błędu',
            'errsev'		=> 'Dotkliwość błędu',
	),
	
	// Errors trace index:
	'backtrace'		=> array(
            'file'			=> 'Plik',
            'function'		=> 'Funkcja',
            'line'			=> 'Linia',
            'args'			=> 'Argumenty',
            'class'			=> 'Klasa',
            'object'		=> 'Instancja',
            'type'			=> 'Typ',
	),
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( PL );
Lang::usePackage( __NAMESPACE__ );

Lang::text( array(
	// Errors title:
	'title'			=> array(
		E_ERROR				=> 'Krytyczny błąd działania',
		E_WARNING			=> 'Ostrzeżenie podczas działania',
		E_PARSE				=> 'Krytyczny błąd parsowania',
		E_NOTICE			=> 'Spostrzeżenie podczas działania',
		E_CORE_ERROR		=> 'Krytyczny błąd inicjacji rdzenia PHP',
		E_CORE_WARNING		=> 'Ostrzeżenie inicjacji rdzenia PHP',
		E_COMPILE_ERROR		=> 'Krytyczny błąd kompilacji',
		E_COMPILE_WARNING	=> 'Ostrzeżenie podczas kompilacji',
		E_USER_ERROR		=> 'Błąd wygenerowany przez użytkownika',
		E_USER_WARNING		=> 'Ostrzeżenie wygenerowane przez użytkownika',
		E_USER_NOTICE		=> 'Sposrzeżenie wygenerowane przez użytkownika',
		E_STRICT			=> 'Sugestia',
		E_RECOVERABLE_ERROR => 'Krytyczny błąd zwrotny',
		E_DEPRECATED		=> 'Spostrzeżenie przestarzałego kodu',
		E_USER_DEPRECATED	=> 'Spostrzeżenie użytkownika o przestarzałych zastosowaniach',
		E_ALL				=> 'Wszystkie błędy',
	),
	
	// Errors description:
	'description'	=> array(
		E_ERROR				=> 'Ten błąd wskazuje sytuacje, w których przywrócenie działania w dalszym ciągu jest niemożliwe. Wykonanie skryptu jest zatrzymane. Np. problem alokacji pamięci.',
		E_WARNING			=> 'Ostrzeżenia podczas działania wskazują błędy popełnione w kodzie przez programistów, które nie powodują zatrzymania wykonywania skryptu. Np. wskazanie błędnej ścieżki dołączenia pliku.',
		E_PARSE				=> 'Błąd parsowania generowany jest tylko przez parser. Np. brak średnika na końcu linii.',
		E_NOTICE			=> 'Spostrzeżenia wskazują, że skrypt napotkał coś, co może spowodować błąd. Mogą wystąpić podczas normalnego działania skryptu. Np. brak indeksu w tablicy.',
		E_CORE_ERROR		=> 'Krytyczny błąd inicjacji rdzenia PHP generowany jest przez rdzeń.',
		E_CORE_WARNING		=> 'Ostrzeżenie inicjacji rdzenia PHP generowane jest przez rdzeń.',
		E_COMPILE_ERROR		=> 'Błąd jest generowany przez Zend Scripting Engine.',
		E_COMPILE_WARNING	=> 'Ostrzeżenie generowane jest przez Zend Scripting Engine.',
		E_USER_ERROR		=> 'Błąd ten generowany jest za pomocą funkcji trigger_error().',
		E_USER_WARNING		=> 'Ostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
		E_USER_NOTICE		=> 'Spostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
		E_STRICT			=> 'Umożliwia włączenie sugestii języka PHP, które opisują jakie zmiany można zaprowadzić w kodzie, aby zapewnić najlepszą interoperacyjność oraz wsteczną zgodność.',
		E_RECOVERABLE_ERROR => 'Zdolne do złapania (przez klauzulę "catch") krytyczne błędy. Wskazują że, wystąpił prawdopodobnie niebezpieczny błąd, który nie opuścił rdzenia w niestabilnym stanie. Jeśli błąd nie jest złapany przez zdefiniowaną przez użytkownika funkcję (patrz: set_error_handler()), aplikacja kończy działanie tak, jakby wystąpił błąd krytyczny (E_ERROR).',
		E_DEPRECATED		=> 'Spostrzeżenia występujące podczas działania programu. Umożliwiają otrzymywanie uwag dotyczących kodu, który może nie działać w przyszłych wersjach.',
		E_USER_DEPRECATED	=> 'Spostrzeżenie to generowane jest za pomocą funkcji trigger_error().',
		E_ALL				=> 'Wszystkie błędy, ostrzeżenia, spostrzeżenia poza poziomem E_STRICT',
	),
	
	// Errors designation:
	'type'			=> array(
		E_ERROR				=> 'E_ERROR',
		E_WARNING			=> 'E_WARNING',
		E_PARSE				=> 'E_PARSE',
		E_NOTICE			=> 'E_NOTICE',
		E_CORE_ERROR		=> 'E_CORE_ERROR',
		E_CORE_WARNING		=> 'E_CORE_WARNING',
		E_COMPILE_ERROR		=> 'E_COMPILE_ERROR',
		E_COMPILE_WARNING	=> 'E_COMPILE_WARNING',
		E_USER_ERROR		=> 'E_USER_ERROR',
		E_USER_WARNING		=> 'E_USER_WARNING',
		E_USER_NOTICE		=> 'E_USER_NOTICE',
		E_STRICT			=> 'E_STRICT',
		E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
		E_DEPRECATED		=> 'E_DEPRECATED',
		E_USER_DEPRECATED	=> 'E_USER_DEPRECATED',
		E_ALL				=> 'E_ALL',
	),
	
	// Errors header:
	'header'		=> array(
		'errloc'		=> 'Lokalizacja',
		'errcnx'		=> 'Kontekst wystąpienia błędu',
		'errcod'		=> 'Kod błędu',
		'errmsg'		=> 'Wiadomość',
		'errtrc'		=> 'Ślad wywołań stosu',
		'errtim'		=> 'Czas wygenerowania błędu',
		'errnum'		=> 'Numer błędu',
		'errsev'		=> 'Dotkliwość błędu',
	),
	
	// Errors trace index:
	'backtrace'		=> array(
		'file'			=> 'Plik',
		'function'		=> 'Funkcja',
		'line'			=> 'Linia',
		'args'			=> 'Argumenty',
		'class'			=> 'Klasa',
		'object'		=> 'Instancja',
		'type'			=> 'Typ',
	),
) );*/