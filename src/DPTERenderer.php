<?php

namespace Hunor\WebtCoreViewsInMvc;

class DPTERenderer
{

    static function renderTemplate($template, $variables): void
    {
        //render for loops
        $template =  DPTERenderer::executeFor($template, $variables);

        //replace all normal variables
        echo DPTERenderer::replaceVariable($variables, $template);
    }


    static private function executeFor($template, $variables): string
    {
        //string before for loop
        $preString = "";
        //string after for loop (exitfor)
        $postString = "";

        //if a for loop in the template was found
        if (preg_match("/##! for [a-zA-Z]* in [a-zA-Z.]* !##/", $template, $loopMatch, PREG_OFFSET_CAPTURE)) {
            //everything before ##! for ... !##
            $preString = substr($template, 0, $loopMatch[0][1]);

            //everything after ##! for ... !##
            $ongoingString = substr($template, $loopMatch[0][1] + strlen($loopMatch[0][0]), strlen($template) - $loopMatch[0][1]);

            //interpret variables inside ##! ... !##
            //the iterator varialbe used inside the for loop
            $iterationVariableString = "";

            //the "original" variable which to iterate from
            $originalVariableString = "";
            if (preg_match("/##! for \K.+?(?=in)/", $loopMatch[0][0], $match)) {
                $iterationVariableString = trim($match[0]);
            } else {
                print_r('Syntax error');
            }
            if (preg_match("/in \K.+?(?= !##)/", $loopMatch[0][0], $match)) {
                $originalVariableString = trim($match[0]);
            } else {
                print_r('Syntax error');
            }

            //the isolated variables array used in the for
            $originalVariables = DPTERenderer::interpretVariable($originalVariableString, $variables);

            //get the end of the for loop
            preg_match("/##! endfor !##/", $ongoingString, $exitMatch, PREG_OFFSET_CAPTURE);

            //string after the for loop
            $postString = substr($ongoingString, $exitMatch[0][1] + strlen($exitMatch[0][0]), strlen($ongoingString) - $exitMatch[0][1]);

            $renderedFor = "";

            //content of the for loop
            $unrenderedString = substr($ongoingString, 0, $exitMatch[0][1]);

            for ($i = 0; $i < sizeof($originalVariables); $i++) {
                //loop through array and replace variables
                $renderedFor .= DPTERenderer::replaceVariable(array("content" => $originalVariables[$i]), $unrenderedString, $iterationVariableString);
            }
        }
        return $preString . $renderedFor . $postString;
    }

    static private function interpretVariable($key, $variables)
    {
        $keys = preg_split("/(\.|\[|\].)/", $key, 2);
        //check if $keys array length is greater than one
        if (sizeof($keys) > 1) {
            //recursivle get into the array
            return DPTERenderer::interpretVariable($keys[1], $variables[$keys[0]]);
        } else {
            //else return the variable
            return $variables[$keys[0]];
        }
    }

    static private function replaceVariable($variables, $content)
    {
        //loop as long as there is still a match
        while ((preg_match("/###[A-Za-z0-9[.\]]+###/", $content, $match, PREG_OFFSET_CAPTURE) != false)) {
            //replace placeholder with actual variable
            $content = str_replace($match[0][0], DPTERenderer::interpretVariable(substr($match[0][0], 3, strlen($match[0][0]) - 6), $variables), $content);
        }
        return $content;
    }
}
