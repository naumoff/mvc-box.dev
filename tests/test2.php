<?php

function removeQueryStringVariables($url)
{
	echo "<pre>";
	if ($url != '') {
		var_dump($url);
		$parts = explode('&', $url, 2);
		var_dump($parts);
		
		if (strpos($parts[0], '=') === false) {
			$url = $parts[0];
		} else {
			$url = '';
		}
	}
	return $url;
}

//   URL                           $_SERVER['QUERY_STRING']  Route
//   -------------------------------------------------------------------
//   localhost                     ''                        ''
//   localhost/?                   ''                        ''
//   localhost/?page=1             page=1                    ''
//   localhost/posts?page=1        posts&page=1              posts
//   localhost/posts/index         posts/index               posts/index
//   localhost/posts/index?page=1  posts/index&page=1        posts/index

$url = 'localhost/posts/index&page=1';
$url = removeQueryStringVariables($url);
echo "<pre>";
echo "WTF?";
var_dump($url);
echo "</pre>";