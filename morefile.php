<?php
/**
 * Created by PhpStorm.
 * User: Hero
 * Date: 2017/11/2
 * Time: 15:03
 */
include "file.php";
/*var_dump($_FILES);*/

?>

<?php
/*使用for循环来读取单个文件的信息*/
for ($i = 0;$i < count($_FILES['file']['name']);$i++){
    if(is_uploaded_file($_FILES['file']['tmp_name'][$i]) && $_FILES['file']['error'][$i] == 0){
        if(move_uploaded_file($_FILES['file']['tmp_name'][$i],'images/'.$_FILES['file']['name'][$i])){
            echo '上传成功!!';
        }else{
            echo 'Failed!!!';
        }
    }

}
?>
