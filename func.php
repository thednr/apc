<?php
define('ROOT_PATH', dirname(__FILE__).'/');

function apc_loadbin_dir($root, $recursively = true){
	$compiled   = true;
	$str = '';
	switch($recursively){
		case    true:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR) as $dir)
				$compiled   = $compiled && apc_loadbin_dir($dir, $recursively);
		case    false:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*.bin') as $file)
				if($file){
					$str = substr($file,0,strpos($file,'.bin'));		//获得PHP文件名
					if($str&&!file_exists($str)){
						file_put_contents($str, '');						//生成一个空的文件
					}
					$compiled   = $compiled && apc_bin_loadfile($file);
				}
			break;
	}
	return  $compiled;
}

function apc_loadbin_files($filearr){
	$compiled = true;
	$str = '';
	if(is_array($filearr)){
		foreach($filearr as $v){
			if($v){
				$str = substr($v,0,strpos($v,'.bin'));		//获得PHP文件名
				if($str&&!file_exists($str)){
					file_put_contents($str, '');			//生成一个空的文件
				}
				$compiled   = $compiled && apc_bin_loadfile($v);
			}
		}
	}
	return $compiled;
}

function apc_compile_dir($root, $recursively = true){
	$compiled   = true;
	switch($recursively){
		case    true:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR) as $dir)
				$compiled   = $compiled && apc_compile_dir($dir, $recursively);
		case    false:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*.php') as $file)
				$compiled   = $compiled && apc_compile_file($file);
				break;
	}
	return  $compiled;
}

function apc_compile_files($filearr){
	$compiled   = true;
	if(is_array($filearr)){
		foreach($filearr as $v){
			if($v){
				if(is_file($v) && file_exists($v)){
					$compiled   = $compiled && apc_compile_file($v);
				}else{
					$compiled = 0;
				}
			}
		}
	}
	return $compiled;
}

function apc_dump_dir($root, $recursively = true){
	$compiled   = true;
	switch($recursively){
		case    true:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR) as $dir)
				$compiled   = $compiled && apc_dump_dir($dir, $recursively);
		case    false:
			foreach(glob($root.DIRECTORY_SEPARATOR.'*.php') as $file)
				$compiled   = $compiled && apc_bin_dumpfile ( [$file], [], $file.'.bin' );
				break;
	}
	return  $compiled;
}

function apc_dump_files($filearr){
	$compiled   = true;
	if(is_array($filearr)){
		foreach($filearr as $v){
			if($v){
				$compiled   = $compiled && apc_bin_dumpfile ( [$v], [], $v.'.bin' );
			}
		}
	}
	return $compiled;
}
?>