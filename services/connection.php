<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_password ="";
	$db_database = "atnaker_server";

	$messages['err_connect_db'] = "Could not connect";
	$messages['err_select_db'] = "Could not select database";
	$messages['err_query'] = "<h1>Error. Sorry for the inconvenience</h1>";
	$messages['max_tries'] = "<h1>Sorry, we're busy. Please try again later</h1>";

	$link = mysql_connect($db_host, $db_user, $db_password) or die($messages['err_connect_db']);
	mysql_select_db($db_database ) or die($messages['err_select_db']);

	mysql_query("SET character_set_client=utf8", $link);
	mysql_query("SET character_set_connection=utf8", $link);
	mysql_query("SET character_set_results=utf8", $link);

	// $sql = "
  //   SELECT
  //     agid,
  //     ppkode,
  //     jobid,
  //     jobno,
  //     jobtglawal,
  //     jobtglakhir
  //   FROM jo
  //   ORDER BY jo.jobid asc
  // ";
  // $result = mysql_query($sql) or die($messages['err_query']);
  // $i = 0;
  // $r = array();
  // while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
  //   $r[$i]["jobid"] = $row['jobid'];
  //   $r[$i]["agid"] = $row['agid'];
  //   $r[$i]["ppkode"] = $row['ppkode'];
  //   $r[$i]["jobno"] = $row['jobno'];
  //   $r[$i]["jobtglawal"] = $row['jobtglawal'];
  //   $r[$i]["jobtglakhir"] = $row['jobtglakhir'];
	//
  //   foreach($r[$i] as $k => $v) {
  //     $r[$i][$k] = esc($v);
  //   }
	//
  //   $sql2 = "
  //     SELECT
  //       jobdid,
  //       jobid,
  //       idjenispekerjaan,
  //       jobdl,
  //       jobdp,
  //       jobdc
  //     FROM jodetail
  //     WHERE
  //       jobid = " . $r[$i]["jobid"] . "
  //   ";
  //   $result2 = mysql_query($sql2) or die($messages['err_query']);
  //   $j=0;
  //   while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC)) {
  //     $r[$i]["detail"][$j]["jobdid"] = $row2["jobdid"];
  //     $r[$i]["detail"][$j]["jpid"] = $row2["idjenispekerjaan"];
  //     $r[$i]["detail"][$j]["jobdl"] = $row2["jobdl"];
  //     $r[$i]["detail"][$j]["jobdp"] = $row2["jobdp"];
  //     $r[$i]["detail"][$j]["jobdc"] = $row2["jobdc"];
	//
  //     foreach($r[$i]["detail"][$j] as $k => $v) {
  //       $r[$i]["detail"][$j][$k] = esc($v);
  //     }
	//
  //     $j++;
  //   }
	//
  //   $i++;
  // }
	//
  // var_dump($r);
	//
	// function esc($value) {
	// 	return $value != null ? preg_replace('/\p{Cc}+/u', '', $value) : null;
	// }
?>
