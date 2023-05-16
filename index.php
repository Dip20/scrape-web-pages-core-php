<?php
include('simple_html_dom.php');

/**
 * link which need to scrape of stackoverflow
 * don't forget to add pagesize
 */
$link = "https://stackoverflow.com/questions/tagged/c?tab=newest&pagesize=15";

/**
 * call function
 */
process($link);


function process(string $link)
{
    $count = get_content($link, true);
    echo "<h2>count: $count</h2><br>";

    $limit = 15;
    $pages = ceil((int) $count / $limit);
    // $pages = 4;
    $i = 1;

    for ($j = 1; $j < $pages; $j++) {

        $link_with_page = ($j == 1) ? $link : $link . "&page=$j";
        $html =  get_content($link_with_page);
        echo "<h2>page: $j</h2><br>";
        echo "<h2>$link_with_page</h2><br>";
        // find all link
        foreach ($html->find('.s-post-summary.js-post-summary') as $e) {

            echo  $i . ": " . $e->find('.s-link', 0)->plaintext . " | ";
            echo  $e->find('.s-post-summary--stats-item-unit', 0) . ": " . $e->find('.s-post-summary--stats-item-number', 0)   . " | ";
            echo  $e->find('.s-post-summary--stats-item-unit', 1) . ": " . $e->find('.s-post-summary--stats-item-number', 1)   . " | ";
            echo  "Accecpted: " . $e->find('.svg-icon.iconCheckmarkSm', 0)   . '|';
            echo  $e->find('.s-post-summary--stats-item-unit', 2) . ": " . $e->find('.s-post-summary--stats-item-number', 2)   . '<br>';
            $i++;
        }

        if ($j == 10) {
            break;
        }
    }
}



/**
 * @param link string
 * @param get_count boolean 
 * @return mix
 * 
 * This is a reusable method to get html content as well as we can use to get count
 */
function get_content(string $link, bool $get_count = false)
{
    $html = file_get_html($link);

    if ($get_count === true) {
        $raw = $html->find('.fs-body3', 0)->plaintext . "<br>";

        if (!empty($raw)) {
            $count = explode("questions", $raw);
            $count = trim($count[0]);
            $count = str_replace(",", "", $count);
        }

        $output = (int) $count;
    } else {
        $output = $html;
    }

    return $output;
}
