<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 2017/11/1
 * Time: 19:40
 */
/*第三部: 判断文件的mime类型是否正确*/

/*判断后缀名和MIME类型是否符合指定需求
例如:
当前项目指定上传后缀为.jpg或.gif的图片，则
*/
$allowSuffix = array('jpg','gif');
//定义允许的后缀名数组
$myImg = explode('.', $_FILES['file']['name']);
/*
explode() 将一个字符串用指定的字符切割，并返回一个数组，这里我们将文件名用'.''切割,结果存在$myImg中，文件的后缀名即为数组的最后一个值
*/
$myImgSuffix = array_pop($myImg);
/*
根据上传文件名获取文件的后缀名
使用in_array()函数，判断上传文件是否符合要求
当文件后缀名不在我们允许的范围内时退出上传并返回错误信息
*/
if(!in_array($myImgSuffix, $allowSuffix)){
    exit("文件后缀名不符");
}
/*
mime类型和文件后缀名的对应关系，我们可以通过很多途径查询到，为了避免用户自主修改文件后缀名造成文件无法使用。
mime类型也必须做出限制检查mime类型，是为了防止上传者直接修改文件后缀名
导致文件不可用或上传的文件不符合要求。
*/
//数组内容为允许上传的mime类型
$allowMime = array(
    "image/jpg",
    "image/jpeg",
    "image/pjpeg",
    "image/gif"
);
if(!in_array($_FILES['file']['type'], $allowMime)){                      //判断上传文件的mime类型是否在允许的范围内
    exit('文件格式不正确，请检查');
    //如果不在允许范围内，退出上传并返回错误信息
}

?>


<?php
/*第四步:  生成指定的路径和文件名
//按照项目的文件安排,生成文件存储路径,为了避免文件名重复而产生错误,按照一定的格式,生成一个随机的文件名
*/
//指定上传文件夹
$path = "upload/images/";
/*
根据当前时间生成随机文件名，本行代码是使用当前时间 + 随机一个0-9的数字组合成文件名，后缀即为前面取到的文件后缀名
*/
$name = date('Y').date('m').date("d").date('H').date('i').date('s').rand(0,9).'.'.$myImgSuffix;
?>

<?php
/*第五步: 判断是否是上传文件*/
//使用is_uploaded_file()判断是否是上传文件,专用函数
if(is_uploaded_file($_FILES['file']['tmp_name'])){

    echo '';
}
?>


<?php
/*第六步: 移动文件到指定位置*/
/*
使用move_uploaded_file()移动上传文件至指定位置,第一个参数为上传文件，第二个参数为我们在前面指定的上传路径和名称。
*/
if(move_uploaded_file($_FILES['file']['tmp_name'], $path.$name)){
    //提示文件上传成功
    echo "上传成功";
}else{
    /*
    文件移动失败，检查磁盘是否有足够的空间，或者linux类系统中文件夹是否有足够的操作权限
    */
    echo '上传失败';
}
/*else{
    echo '不是上传文件';
}*/


?>