<?php
	$id = $_GET['id'];
	$connection = mysql_connect("localhost","root1","123456");
	mysql_select_db("virdy",$connection);
	$myquery = "select * from virdy where id=$id";
	$result = mysql_query($myquery);
	while($row = mysql_fetch_array($result)){
		echo "编号: ".$row['id']."<br >";
		echo "标题: ".$row['title']."<br >";
		echo "内容: ".$row['text']."<br >";
		echo "<hr>";
	}
	mysql_close($connection);
	echo "后台执行的SQL语句: ".$myquery."<hr>";
	#mysql_free_result($result);
?>