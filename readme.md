# php实现文件上传的功能
文件上传后先是被存储为临时文件,然后判断临时文件是上传的文件后,在将其移动到上传所指定的文件夹中.

*注意在file.php中$MAX_FILE_SIZE指定的值,单位是bytes*

使用switch()函数检测并输出错误码.

使用if-else语句对后面的条件进行逐一判断.

在多文件上传中,上传的多个文件会被存储到同一个数组中.因此,可以使用for循环,轮流读取单个文件的信息,并将其移动到指定的位置.

*待续*
