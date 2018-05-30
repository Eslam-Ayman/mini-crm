<?php 

function test($request , $locale){

	// Blade::directive('getUrl', function ($locale) use ($request) {
            
        
 //    });

	$segments = $request->segments();

	array_shift($segments);
	// dump('ssss');

	return url($locale . '/' . implode('/', $segments) );
	
}