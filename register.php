<?php
require('./libs/Smarty.class.php');
require('./include/mysql.php');
$smarty = new Smarty;
$db = new mysqlconnect();
include_once './include/include.php';
require('./include/juglogin.php');
$smarty->assign("Name","注册",true);

$error="";

if($_POST['submit'])
{ 
	//提交后的页面
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repassword = $_POST['repass'];
	$email = $_POST['email'];
	
	if(empty($username))
	{
		$error .= '用户名不能为空<br>';
	}
	if(empty($password))
	{
		$error .= '密码不能为空<br>';
	}
	if(empty($repassword))
	{
		$error .= '再次输入密码不能为空<br>';
	}
	if(empty($email))
	{
		$error .= '邮箱不能为空<br>';
	}
	if(strlen($password) < 6)
	{
		$error .= '密码长度不能小于6位<br>';
	}
	if($_POST['password']!=$_POST['repass'])
	{
		$error .= '2次密码不一样<br>';
	}
	

	
/*	if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username))
	{
		$error .= '用户名不匹配<br>';
	}
	if(!preg_match('/^w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*$/', $email))
	{
		$error .= '邮箱不匹配<br>';
	} */

	
	if(!empty($error))
	{		
		$smarty->assign("Error",$error,true);
		unset($error);
	}
	else
	{
		$sql_query= "select * from users where username='$username';";
		$arr = $db->query_array($sql_query);
		if(count($arr)>0)
		{
			$smarty->assign("Error","用户名存在",true);
		}
		else
		{
			$password = MD5($password);
			$regdate = time();
			$sql = "INSERT INTO users(username,password,email)VALUES('$username','$password','$email')";
			$id= $db->query_insert($sql);
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			$smarty->assign("message","index.php",true);
			header("Location: index.php");
		}
	}	
}	
//未提交的页面， 显示输入用户名，密码，电子邮件
else
{
	if(strlen($error)==0)
	{
		$smarty->assign("Error","",true);
		unset($error);
	}
}
	/*if(success)
	{
		//如果成功，输出一个提示页面（general的提示页面)
	}
	else
	{
		//如果失败,则返回输入页面，并且，提示出错的地方
		//把出错信息放到一个数组里面输出到页面，提示给用户
	}	*/
	


//$smarty->assign("header2",$smarty->fetch("header2.tpl"));



$smarty->display('register.tpl');

?>
