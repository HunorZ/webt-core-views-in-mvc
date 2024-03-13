<?php

namespace Hunor\WebtCoreViewsInMvc;

class DPTERenderer
{

    static function renderTemplate($template, $variables): void
    {
        //DPTERenderer::replaceVariableV2($variables, $template);
        $template =  DPTERenderer::executeFor($template, $variables);
        echo DPTERenderer::replaceVariable($variables, $template);
    }


    static private function executeFor($template, $variables): string
    {
        //string before for loop
        $preString = "";
        //string after for loop (exitfor)
        $postString = "";

        //if for loop was found
        if (preg_match("/##! for [a-zA-Z]* in [a-zA-Z.]* !##/", $template, $loopMatch, PREG_OFFSET_CAPTURE)) {
            $preString = substr($template, 0, $loopMatch[0][1]);

            //everything after ##! for ... !##
            $ongoingString = substr($template, $loopMatch[0][1] + strlen($loopMatch[0][0]), strlen($template) - $loopMatch[0][1]);

            //interpret variables inside ##! ... !##
            //the variable in which the content is written in
            $iterationVariableString = "";

            //the variable which is in the variables parameter
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

            $originalVariables = DPTERenderer::interpretVariable($originalVariableString, $variables);

            preg_match("/##! endfor !##/", $ongoingString, $exitMatch, PREG_OFFSET_CAPTURE);

            $postString = substr($ongoingString, $exitMatch[0][1] + strlen($exitMatch[0][0]), strlen($ongoingString) - $exitMatch[0][1]);

            $renderedFor = "";
            $unrenderedString = substr($ongoingString, 0, $exitMatch[0][1]);
            for ($i = 0; $i < sizeof($originalVariables); $i++) {
                $renderedFor .= DPTERenderer::replaceVariable(array("content" => $originalVariables[$i]), $unrenderedString, $iterationVariableString);
            }
        }
        return $preString . $renderedFor . $postString;
    }

    static private function interpretVariable($key, $variables)
    {
        $keys = preg_split("/(\.|\[|\].)/", $key, 2);
        if (sizeof($keys) > 1) {
            return DPTERenderer::interpretVariable($keys[1], $variables[$keys[0]]);
        } else {
            return $variables[$keys[0]];
        }
    }

    static private function replaceVariable($variables, $content)
    {
        while ((preg_match("/###[A-Za-z0-9[.\]]+###/", $content, $match, PREG_OFFSET_CAPTURE) != false)) {

            $content = str_replace($match[0][0], DPTERenderer::interpretVariable(substr($match[0][0], 3, strlen($match[0][0]) - 6), $variables), $content);
        }
        return $content;
    }
}
