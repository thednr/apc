# apc
apc manager 本项目仅适用于PHP5.4 + APC3.1.13版本

# 什么是APC
The Alternative PHP Cache (APC) is a free and open opcode cache for PHP. Its goal is to provide a free, open, and robust framework for caching and optimizing PHP intermediate code.
可选的（灵活的）PHP缓

# APC的用途
1、缓存PHP代码，加速运行速度
用于各网站，提升PHP的运行速度。

2、隐藏PHP代码，做到代码保护
在生产环境中对PHP源码的保护。

# APC安装
下载地址：http://pecl.php.net/package/apc
windows  载入php_apc.dll

linux   安装apc后使用phpize载入

- APC扩展最新是3.1.13 ，这个版本可以支持PHP5.3 ，PHP5.4也是建议不要使用。如果要使用APC但又是高版本的PHP，则需要使用APCU扩展。

# APC配置
apc.enabled = 1            开启
apc.stat= 0		    是否判断源码被更新
apc.*hint= 0		    源文件数量
apc.ttl = 0		    过期时间（秒）
apc.enable_cli		    命令行运行（用于测试）
...35个左右配置参数

# APC函数
apc_compile_file ()          绕过过滤器，直接将PHP文件存储在APC缓存中
apc_bin_dumpfile()           输出缓存中的文件或变量到二进制文件
apc_bin_loadfile()           从二进制内容加载到APC缓存中
...近20个函数

# CLI模式的使用
批量加载缓存	$ find ./ -name "*.php" -exec \
				php -r "apc_compile_file( '{}' . '.php');" ;

批量导入缓存文件	$ find ./ -name "*.php" -exec \
				php -r "apc_bin_dumpfile(array('{}'),\
				array(), '{}' . '.bin');" ;

批量载入缓存	$ find ./ -name "*.bin" -exec \
				php -r "apc_bin_loadfile('{}' . '.bin');" ;

# APC的参考资料
http://php.net/manual/en/book.apc.php
http://www.laruence.com/2012/08/16/2701.html
