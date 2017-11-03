<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 2017/11/1
 * Time: 15:45
 */
/*var_dump($_FILES);*/

?>

<?php


    /*第一步:判断错误码*/
    if ($_FILES['file']['error']   > 0) {
        switch ($_FILES['file']['error']  ) {    //错误码不为0，即文件上传过程中出现了错误
            case '1':
                echo '文件过大';
                break;
            case '2':
                echo '文件超出指定大小';
                break;
            case '3':
                echo '只有部分文件被上传';
                break;
            case '4':
                echo '文件没有被上传';
                break;
            case '6':
                echo '找不到指定文件夹';
                break;
            case '7':
                echo '文件写入失败';
                break;
            default:
                echo "上传出错<br/>";
        }
    } else {
        /*第二步: 判断文件是否超出大小*/

        //错误码为0，即上传成功，可以进行后续处理，处理流程见下文
        //当前上传文件无误，运行本段代码
        //判断文件是否超出了指定的大小
        //单位为byte
        $MAX_FILE_SIZE = 100000000;
        if ($_FILES['file']['size']   > $MAX_FILE_SIZE) {
            //判断，如果上传的文件，大小超出了我们给的限制范围，退上传并产生错误提示
            exit("文件超出指定大小");
        }


        /*第三步:  判断文件的mime类型是否正确*/
        $allowSuffix = array('jpg', 'gif', 'png');/*允许上传的文件后缀名*/
        $myImg = explode('.', $_FILES['file']['name']);/*上传的文件名*/
        $myImgSuffix = array_pop($myImg);/*array_pop()函数的功能: 根据上传文件名 获取文件的后缀名*/
        if (!in_array($myImgSuffix, $allowSuffix)) {
            exit("文件后缀名不符!");
        }
        $allowMime = array(
            "image/jpg",
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/tiff"
        );/*这里一定要用"",因为''不能转义*/
        if (!in_array($_FILES['file']['type'], $allowMime)) {
            exit('文件格式不正确!');/*exit()函数:退出上传并返回错误信息*/
        }


        /*第四步: 生成指定的路径和文件名*/
        $path = "images/";/*定义路径,指定为上传的文件夹*/
        $name = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(0, 9) . '.' . $myImgSuffix;/*按照时间随机生成文件名*/


        /*第五步: 判断是否是上传文件*/
        /*从临时文件中判断*/
        if (is_uploaded_file($_FILES['file']['tmp_name']  )) {

            /*第六步: 移动文件到指定位置*/
            if (move_uploaded_file($_FILES['file']['tmp_name']  , $path . $name)) {
                echo '上传成功' . '';
            } else {
                echo '上传失败!!';
            }

        } else {
            echo $_FILES['file']['tmp_name']   . '不是上传文件!';
        }


    }


?>
