<?php
/**
 * Created by PhpStorm.
 * User: 63254
 * Date: 2018/11/18
 * Time: 19:49
 */

//连接数据库
function connect($mysql){
    //连接数据库
    $db_host = 'localhost';    //ip端口
    $db_name = 'dormsystem';    //数据库名称
    $db_user = 'root';
    $db_pwd = 'TONYpapa';

    $mysql->connect($db_host,$db_user,$db_pwd,$db_name);
    if (!$mysql){
        echo mysqli_connect_error();
        return false;
    }
    //编码
    $mysql->set_charset("utf8");
    //编码
    $mysql->query('set names utf8');

    return true;
}

function checktoken()
{
    $post = $_POST;
    $token = $post['token'];
    $id = get_id($token);

}

function get_id($token)
{

}
/*
     * table 表名  data想要插入的字段名和对应的值
     */
function insert($mysql,$table,$data){
    //构造语句
    $str1 = "(";
    $str2 = "(";
    $i = 0;
    foreach ($data as $k => $v){
        $str1.="`".$k."`";
        $str2.="'".$v."'";
        $i++;
        if ($i != count($data)){
            $str1.=',';
            $str2.=',';
        }
    }
    $str1.=")";
    $str2.=")";
    //增
    $sql = "insert into ".$table." ".$str1." values ".$str2;
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    return true;
}

/*
 * sql 语句
 */
function sql_insert($mysql,$sql){
    try{
        $result = $mysql->query($sql);
        if($result === false){
            //执行失败，抛出错误
            throw new Exception(json_encode([
                'code' => 400,
                'msg' => $mysql->error
            ]),400);
        }
        return true;
    }catch(Exception $e){
        http_response_code($e->getCode());
        exit($e->getMessage());
    }
}

/*
 * table 表名  condition查询条件  limit
 */
function find($mysql,$table,$condition=[],$limit = ''){
    //构造语句
    $str = "where ";
    if ($condition == []) $str = "";
    $i = 0;
    foreach ($condition as $k => $v){
        $str.= $k." = '".$v."' ";
        $i++;
        if ($i != count($condition)){
            $str.='AND ';
        }
    }
    $sql = "select * from `".$table."` ".$str." ".$limit;
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    $data = $result->fetch_assoc();
    return $data;
}

/*
 * sql 语句
 */
function sql_find($mysql,$sql){
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    $data = $result->fetch_assoc();
    return $data;
}


/*
 * table 表名  condition查询条件
 */
function select($mysql,$table,$condition = [],$limit = ''){
    //构造语句
    $str = "where ";
    if ($condition == []) $str = "";
    $i = 0;
    foreach ($condition as $k => $v){
        $str.=$k." = '".$v."' ";
        $i++;
        if ($i != count($condition)){
            $str.='AND ';
        }
    }
    $sql = "select * from `".$table."` ".$str." ".$limit;
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    //自定义返回数据数组
    $i = 0;
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
    }
    return $data;
}


/*
 * sql 语句
 */
function sql_select($mysql,$sql){
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    //自定义返回数据数组
    $i = 0;
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
    }
    return $data;
}


/*
 * table 表名  condition查询条件
 */
function delete($mysql,$table,$condition = []){
    //构造语句
    $str = "where ";
    if ($condition == []) $str = "";
    $i = 0;
    foreach ($condition as $k => $v){
        $str.=$k." = '".$v."' ";
        $i++;
        if ($i != count($condition)){
            $str.='AND ';
        }
    }
    $sql = "delete from `".$table."` ".$str;
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    return true;
}


/*
 * table 表名  condition查询条件
 */
function update($mysql,$table,$data,$condition = []){
    //构造语句
    $string = '';
    $j = 0;
    foreach ($data as $k => $v){
        $string.="`".$k."` = '".$v."'";
        $j++;
        if ($j != count($data)){
            $string.=',';
        }
    }

    $str = "where ";
    if ($condition == []) $str = "";
    $i = 0;
    foreach ($condition as $k => $v){
        $str.=$k." = '".$v."' ";
        $i++;
        if ($i != count($condition)){
            $str.='AND ';
        }
    }
    $sql = "UPDATE `".$table."` SET ".$string.' '.$str;
    var_dump($sql);
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    return true;
}