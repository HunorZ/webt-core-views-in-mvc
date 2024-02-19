<?php

namespace Hunor\WebtCoreViewsInMvc;

require_once 'vendor/autoload.php';


$variables = array(
    "test" => "asdfasdf",
    "hotels" => array(
        "good" => array(
            array(
                "name" => "The Plaza Hotel",
                "location" => "Location: New York City, USA",
                "information" => array(
                    array(
                        "topic" => "Overview",
                        "text" => "An iconic landmark located at the prestigious corner of Fifth Avenue and Central Park South, The
            Plaza Hotel is synonymous with timeless elegance and luxury. Since its opening in 1907, it has been
            a popular choice for celebrities, royalty, and discerning travelers. The hotel's opulent interiors,
            adorned with Beaux-Arts décor, and its impeccable white-glove service make it a quintessential New
            York experience."
                    ),
                    array(
                        "topic" => "Amenities",
                        "text" => "The Plaza offers the grandeur of old-world elegance with the comforts
                of modern amenities, including luxurious rooms and suites, the famous Palm Court for afternoon tea,
                several high-end dining options, a lavish Champagne Bar, the renowned Plaza Food Hall, and a
                comprehensive health and wellness center."
                    ),
                    array(
                        "topic" => "Unique Feature",
                        "text" => "The Plaza is home to the Eloise Suite, inspired by the fictional
                young girl who lived at the hotel in the beloved children’s books. This whimsically decorated suite
                offers a one-of-a-kind stay, complete with Eloise-themed books, toys, and a tea set."
                    )
                )
            ),
            array(
                "name" => "Burj Al Arab Jumeirah",
                "location" => "Location: Dubai, United Arab Emirates",
                "information" => array(
                    array(
                        "topic" => "Overview",
                        "text" => "Standing on its own artificial island and designed to resemble the
                sail of a ship, the Burj Al Arab Jumeirah is often recognized as one of the most luxurious hotels in
                the world. This all-suite hotel soars to a height of 321 meters, dominating the Dubai skyline with
                its distinctive silhouette. Offering unparalleled standards of comfort and service, the Burj Al Arab
                is a symbol of modern Dubai’s luxury and opulence."
                    ),
                    array(
                        "topic" => "Amenities",
                        "text" => "The hotel boasts suites with stunning views, personal butler service,
                nine world-class restaurants and bars, two swimming pools, a private beach, and the Talise Spa. Each
                suite is a duplex with floor-to-ceiling windows, offering breathtaking views of the Arabian Gulf."
                    ),
                    array(
                        "topic" => "Unique Feature",
                        "text" => "The Burj Al Arab offers an unforgettable arrival experience by options of a chauffeur-driven
                Rolls-Royce, helicopter, and a private jet service. The hotel also features the Skyview Bar,
                suspended 200 meters above sea level, providing guests with spectacular panoramic views of the city
                and the gulf."
                    )
                )
            ),
            array(
                "name" => "The Plaza Hotel",
                "location" => "Location: New York City, USA",
                "information" => array(
                    array(
                        "topic" => "Overview",
                        "text" => "An iconic landmark located at the prestigious corner of Fifth Avenue and Central Park South, The
                Plaza Hotel is synonymous with timeless elegance and luxury. Since its opening in 1907, it has been
                a popular choice for celebrities, royalty, and discerning travelers. The hotel's opulent interiors,
                adorned with Beaux-Arts décor, and its impeccable white-glove service make it a quintessential New
                York experience."
                    ),
                    array(
                        "topic" => "Amenities",
                        "text" => "The Plaza offers the grandeur of old-world elegance with the comforts
                of modern amenities, including luxurious rooms and suites, the famous Palm Court for afternoon tea,
                several high-end dining options, a lavish Champagne Bar, the renowned Plaza Food Hall, and a
                comprehensive health and wellness center."
                    ),
                    array(
                        "topic" => "Unique Feature",
                        "text" => "The Plaza is home to the Eloise Suite, inspired by the fictional
                young girl who lived at the hotel in the beloved children’s books. This whimsically decorated suite
                offers a one-of-a-kind stay, complete with Eloise-themed books, toys, and a tea set."
                    )
                )
            )
        )
    )
);



$template = file_get_contents('src/template/template.html');
echo renderTemplate($template, $variables);




function renderTemplate($template, $varialbes): string
{
    $template = executeFor($template, $varialbes);
    return replaceVariable($varialbes, $template);

    //render inner loop => stack
    //go outwords and finally replace it

}


function executeFor($template, $varialbes): string
{
    //string before for loop
    $preString = "";
    //string after for loop (exitfor)
    $postString = "";

    if (preg_match("/##! for [a-zA-Z]* in [a-zA-Z.]* !##/", $template, $matches, PREG_OFFSET_CAPTURE)) {
        $preString = substr($template, 0, $matches[0][1]);

        //everything after ##! for ... !##
        $ongoingString = substr($template, $matches[0][1] + strlen($matches[0][0]), strlen($template) - $matches[0][1]);

        //interpret variables inside ##! ... ##!
        //the variable in which the content is written in
        $iterationVariableString = "";

        //the variable which is in the variables parameter
        $originalVariableString = "";
        if (preg_match("/##! for \K.+?(?=in)/", $matches[0][0], $match)) {
            $iterationVariableString = trim($match[0]);
        } else {
            print_r('Syntax error');
        }
        if (preg_match("/in \K.+?(?= !##)/", $matches[0][0], $match)) {
            $originalVariableString = trim($match[0]);
        } else {
            print_r('Syntax error');
        }

        $originalVariables = interpretVariable($originalVariableString, $varialbes);

        preg_match("/##! endfor !##/", $ongoingString, $exitMatch, PREG_OFFSET_CAPTURE);
        if (!preg_match("/##! for [a-zA-Z]* in [a-zA-Z.]* !##/", $ongoingString, $forMatch, PREG_OFFSET_CAPTURE)) {
            $forMatch[0][1] = $exitMatch[0][1];
        }

        $postString = substr($ongoingString, $exitMatch[0][1] + strlen($exitMatch[0][0]), strlen($ongoingString) - $exitMatch[0][1]);
        if ($forMatch[0][1] < $exitMatch[0][1]) {
            print_r("inner for");

            for ($i = 0; $i < sizeof($originalVariables); $i++) {
                $loopVariables[$iterationVariableString] = $originalVariables[$i];
                print_r("<!--" . $ongoingString . "-->");
                echo "<br>";
                print_r("<!--" . executeFor($ongoingString, $loopVariables) . "-->");
            }
        } else {

            print_r("last for");
            $template = "";
            $unrenderedString = substr($ongoingString, 0, $exitMatch[0][1]);
            for ($i = 0; $i < sizeof($originalVariables); $i++) {
                $template .= replaceVariable($originalVariables[$i], $unrenderedString, $iterationVariableString);
            }
        }
        //check for any inner for loop
        //if index of next for stuff is before next ##! endfor !## 


        //if yes... get into
        //if no... replace
    }
    return $preString . $template . $postString;
}

function interpretVariable($key, $variables)
{
    $keys = preg_split("/\\./", $key, 2);
    if (sizeof($keys) > 1) {
        return interpretVariable($keys[1], $variables[$keys[0]]);
    } else {
        return $variables[$keys[0]];
    }
}

function replaceVariable($varialbes, $content, $preVariable = ""): string
{
    //simple variable stuff
    //subvariable stuff.stuff
    //array stuff[0]
    //array with subvariables stuff[0].stuff
    //any other recursive variety
    if (array_is_list($varialbes)) {
        for ($i = 0; $i < sizeof($varialbes); $i++) {
            $content = replaceVariable($varialbes[$i], $content, ($preVariable == "") ? "[" . $i . "]" : $preVariable . "." . "[" . $i . "]");
        }
    } else {
        foreach (array_keys($varialbes) as $key) {
            if (is_array($varialbes[$key])) {
                if (array_is_list($varialbes[$key])) {
                    for ($i = 0; $i < sizeof($varialbes[$key]); $i++) {
                        $content = replaceVariable($varialbes[$key][$i], $content, ($preVariable == "") ? $key . "[" . $i . "]" : $preVariable . "." . $key . "[" . $i . "]");
                    }
                } else {
                    $content = replaceVariable($varialbes[$key], $content, ($preVariable == "") ? $key : $preVariable . "." . $key);
                }
            } else {
                $content = str_replace("###" . (($preVariable == "") ? $key : $preVariable . "." . $key) . "###", $varialbes[$key], $content);
            }
        }
    }
    return $content;
}
