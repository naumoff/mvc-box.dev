<?php
echo "<pre>";
$route = '{controller}/{action}/{id:\d+}';
print_r("исходный путь: ".$route."\n");

$pattern = '/\//';
$replacer = '\\/';
$route = preg_replace($pattern, $replacer, $route);
print_r("поменяли слеши: ".$route."\n");

// жмем CTRL+U так как '<' '>' не отражаются
$pattern = '/\{([a-z]+)\}/';
$replacer = '(?P<\1>[a-z-]+)';
$route = preg_replace($pattern, $replacer, $route);
print_r($route."\n");
// (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)\/{id:\d+}

$pattern = '/\{([a-z-]+):([^\}]+)\}/';
$replacer = '(?P<\1>\2)';
$route = preg_replace($pattern,$replacer,$route);
print_r($route);
// (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)\/(?P<id>\d+)