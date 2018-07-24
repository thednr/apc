<?php
header('Content-Type:text/html;charset=utf-8');
require 'func.php';
$return = 0;
$isclear = isset($_POST['isclear'])?1:0;
$isrecursively = isset($_POST['isrecursively'])?1:0;
$dir = isset($_POST['dir'])?$_POST['dir']:'';
$files = isset($_POST['file'])?$_POST['file']:'';
$loadtype = $_POST['loadtype'];
$loadstr =$loadtype=='load'?'载入':'装载'; 
$cacheinfo = '';
//echo 'isclear:'.$isclear.'<br/>';
//echo 'isrecursively:'.$isrecursively.'<br/>';
//print_r($_POST);exit();
if(!empty($_POST)){
	if(function_exists('apc_compile_file')&&function_exists('apc_bin_dumpfile')&&function_exists('apc_bin_loadfile')){
		if($loadtype=='down'){
			if(!$dir){	//选择文件进行装载
				if($isclear){
					$clear = apc_clear_cache();
				}
				$return = apc_compile_files($files);
			}else{	
				//选择目录进行装载
			    if($isclear){
			    	$clear = apc_clear_cache();
			    }
			    $return = apc_compile_dir($dir, $isrecursively);
			}
			//$cacheinfo = apc_cache_info();echo'<pre>';print_r($cacheinfo);exit();
			if($return){
				//完成缓存后进行BIN文件的导出
				if(!$dir){
					$return = apc_dump_files($files);
				}else{
					$return = apc_dump_dir($dir,$isrecursively);
				}
				if($return){
					$cacheinfo = apc_cache_info();
				}
			}else{
				die('Cache Not Created');
			}
		}else{
			if(!$dir){	//选择文件进行载入
				if($isclear){
					$clear = apc_clear_cache();
				}
				$return = apc_loadbin_files($files);
			}else{
				//选择目录进行载入
				if($isclear){
					$clear = apc_clear_cache();
				}
				$return = apc_loadbin_dir($dir, $isrecursively);
			}
			if($return){
				$cacheinfo = apc_cache_info();
			}
		}
	}else{
		die('APC is not present, nothing to do.');
	}
}else{
	die('The parameter is incorrect.');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" type="text/css" rel="stylesheet" />
<title>APC<?=$loadstr?></title>
<style>
body, button, input, textarea { font: 12px/1.5 "宋体",tahoma,arial,sans-serif;}
span{ cursor:pointer;}
.list_table{width: 100%;border-top: 1px solid #d8d8d8;border-right: 1px solid #d8d8d8;text-align: center;}
.list_table th{height: 28px;background:#f8f8f8;line-height:28px;border-left: 1px solid #d3dbde; border-bottom: 1px solid #d8d8d8; }
.list_table td{border-bottom: 1px solid #d8d8d8;border-left: 1px solid #d8d8d8;padding:5px;}
</style>
<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<table class="TableFrame" style="width:800px;">
	<caption class="ListTitle">APC<?=$loadstr?> <?=$loadstr?>结果</caption>
	<tbody><tr>
		<td>&nbsp;</td>
		<td align="right">&nbsp;</td>
	</tr>
</tbody></table>

<div class="TableFrame" style="width:800px;">
    已<?=$loadstr?>导出<?php echo count($cacheinfo['cache_list']);?></>个文件<br />
    <?=$loadstr?>总大小为<?php echo $cacheinfo['mem_size'];?>KB<br />
    <span id="xy"  onclick="xy();">查看详情</span>

    <div style="display:none " id="xy1">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
	    <thead>
			<tr>
				<th>序号</th>
				<th>文件名</th>
				<th>创建时间</th>
				<th>文件大小</th>
			</tr>
	    </thead>
	    <tbody>
	    	<?php if($cacheinfo){ 
	    			foreach($cacheinfo['cache_list'] as $k=>$v){
	    	?>
			<tr class="tr">
				<td><?=$k+1?></td>
				<td><?=$v['filename']?></td>
				<td><?=date('Y-m-d H:i',$v['creation_time']) ?></td>
				<td><?=$v['mem_size']?>KB</td>
			</tr>
			<?php }}?>
	    </tbody>
	</table>
</div>
</div>
<script type="text/javascript">
$(function(){
    $('#xy').click(function(){
        $('#xy1').toggle();
    })
})
</script>
</body>
</html>
