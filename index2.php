<?php

// $html = '<html><body><h1>Heading</h1><p>Some text</p></body></html>';

// $dom = new DOMDocument();
// $dom->loadHTML($html);

// // Get the first h1 element
// $heading = $dom->getElementsByTagName('h1')->item(0);

// // Get the text content of the h1 element
// $headingText = $heading->textContent;

// // Get the first p element
// $paragraph = $dom->getElementsByTagName('p')->item(0);

// // Get the text content of the p element
// $paragraphText = $paragraph->textContent;

// echo "Heading: $headingText\n";
// echo "Paragraph: $paragraphText\n";




$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://stackoverflow.com/questions/tagged/c%23?tab=newest&pagesize=50');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');
$content = curl_exec($curl);

curl_close($curl);

// Output content
// echo $content;exit;



// $dom = new DOMDocument();
// @$dom->loadHTML($content);

// // Get the first h1 element
// $heading = $dom->getElementsByTagName('h1')->item(0);

// // Get the text content of the h1 element
// $headingText = $heading->textContent;

// // Get the first p element
// // $paragraph = $dom->getElementsByTagName('p')->item(0);



// // Get the text content of the p element
// $paragraphText = $paragraph->textContent;

// echo "Heading: $headingText\n";
// echo "Paragraph: $paragraphText\n";






// // Step 2: Load the HTML content into a new DOMDocument object
$dom = new DOMDocument();
@$dom->loadHTML($content);

// Step 3: Query the HTML content using DOMXPath
$xpath = new DOMXPath($dom);
$classname = "js-accepted-answer-indicator";
$nodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
echo '<pre>';
print_r($nodes);
exit;
