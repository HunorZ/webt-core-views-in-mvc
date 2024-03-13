<?php

namespace Hunor\WebtCoreViewsInMvc;

require_once 'vendor/autoload.php';


//get variables
$variables = HotelInformationProvider::getHotels();

//get the template
$template = file_get_contents('src/template/template.html');

// 
DPTERenderer::renderTemplate($template, $variables);