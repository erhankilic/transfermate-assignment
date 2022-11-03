<?php

include_once '../Classes/XMLTool.php';

$path = __DIR__ . '/../xml_data/';
XMLTool::scanFolder($path);