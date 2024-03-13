<?php

namespace Hunor\WebtCoreViewsInMvc;

require_once 'vendor/autoload.php';


$variables = HotelInformationProvider::getHotels();

$template = file_get_contents('src/template/template.html');
DPTERenderer::renderTemplate($template, $variables);