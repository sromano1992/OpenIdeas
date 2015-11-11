<?php
    use Stichoza\GoogleTranslate\TranslateClient;
    


    function translate(){
	require __DIR__ . '/vendor/autoload.php';	
	echo "<h1>Translation</h1>";
	$tr = new TranslateClient(); // Default is from 'auto' to 'en'
	$tr->setSource('it'); // Translate from English
	$tr->setTarget('en'); // Translate to Georgian
	echo "Ciao a tutti ==> ";
	echo $tr->translate('Ciao a tutti!');
    }
        
        
    function sentimentAnalysis(){
	echo "<br><br>";
	echo "<h1>Sentiment analysis</h1>";
	require_once __DIR__ . '/libs/sentimentAnalysis/autoload.php';
	$strings = array(
	    1 => 'Weather today is rubbish',
	    2 => 'This cake looks amazing',
	    3 => 'His skills are mediocre',
	    4 => 'He is very talented',
	    5 => 'She is seemingly very agressive',
	    6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
	    7 => 'To be or not to be?',
	    8 => "Sad"
	);
    
	$sentiment = new \PHPInsight\Sentiment();
	foreach ($strings as $string) {
	
		// calculations:
		$scores = $sentiment->score($string);
		$class = $sentiment->categorise($string);
	
		// output:
		echo "String: $string\n";
		echo "Dominant: $class, scores: ";
		print_r($scores);
		echo "<br><br>";
	}
    }

?>