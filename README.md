# APC Maneger
1、本应用仅适用于PHP5.4 和 APC3.1.13  \
2、使用index.html可选择性的对PHP程序文件进行解析，解析成功后APC会把PHP解析成字节码并存储在内存中。本程序会将内存中的字节码文件导出.bin文件至PHP程序文件相应的目录。    \
3、使用load.html可选择性的将.bin文件加载至内存，基本上PHP已解析的Opcache code就会被catch中，访问该PHP程序文件时就会直接读内存中的程序。缓存时间则由apc.ttl来决定。这时可以将被缓存的PHP程序写成空文件，只要PHP程序不变，再次加载时，只要同样上传.bin文件即可。   \
4、在PHP5.5后，应用opcache扩展则没有这么多流程，只需要opcache_compile_file()函数即可以将PHP程序文件解析并加载到内存，减少相应的操作。


# 什么是APC
The Alternative PHP Cache (APC) is a free and open opcode cache for PHP. Its goal is to provide a free, open, and robust framework for caching and optimizing PHP intermediate code.
可选的（灵活的）PHP缓存

# APC的用途
1、缓存PHP代码，加速运行速度用于各网站，提升PHP的运行速度。

2、隐藏PHP代码，做到代码保护在生产环境中对PHP源码的保护。

# APC安装
下载地址：http://pecl.php.net/package/apc    \
windows  载入php_apc.dll  \
linux   安装apc后使用phpize载入
- APC扩展最新版本为3.1.13 ，这个版本可以支持PHP5.3、PHP5.4，其中PHP5.4在官方不建议使用。如果要使用APC但又是PHP5.5+的版本，则需要使用APCU扩展和Opcache扩展。

# APC配置
apc.enabled = 1            开启\
apc.stat= 0		    是否判断源码被更新\
apc.*hint= 0		    源文件数量\
apc.ttl = 0		    过期时间（秒）\
apc.enable_cli		    命令行运行（用于测试）\
...35个左右配置参数

# APC函数
apc_compile_file ()          绕过过滤器，直接将PHP文件存储在APC缓存中\
apc_bin_dumpfile()           输出缓存中的文件或变量到二进制文件\
apc_bin_loadfile()           从二进制内容加载到APC缓存中\
...近20个函数

# CLI模式的使用
批量加载缓存	$ find ./ -name "*.php" -exec php -r "apc_compile_file( '{}' . '.php');" ;  \
批量导入缓存文件	$ find ./ -name "*.php" -exec php -r "apc_bin_dumpfile(array('{}'), array(), '{}' . '.bin');" ;   \
批量载入缓存	$ find ./ -name "*.bin" -exec php -r "apc_bin_loadfile('{}' . '.bin');" ;

# APC的参考资料
http://php.net/manual/en/book.apc.php \
http://www.laruence.com/2012/08/16/2701.html    \
http://www.php.net/manual/en/book.apc.php

# APC 升级opcache和apcu的参考资料
https://www.devside.net/wamp-server/installing-apc-for-php-5-5 \
https://support.cloud.engineyard.com/hc/en-us/articles/205411888-PHP-Performance-I-Everything-You-Need-to-Know-About-OpCode-Caches \
https://www.jianshu.com/p/bec52fea7ff7
