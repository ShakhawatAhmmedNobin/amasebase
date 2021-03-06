<?php
define('_VALID_INCLUDE', TRUE);
include ("jpgraph.php");
include ("jpgraph_pie.php");
include ("jpgraph_pie3d.php");
require "../config.inc.php";
require "../modul.inc.php";

session_name('amasebase');
session_start();

    if (!($db_link)) { die ("Es konnte keine Verbindung zum Server aufgebaut werden - Error #21 - SQL-Message: ". mysql_error()); }

    // Datenbank ausw�hlen
    mysql_select_db($datenbank) OR die("Datenbank nicht vorhanden/erreichbar - Error #22 - SQL-Message: " . mysql_error());

	$query = "SELECT COUNT(*) FROM grades WHERE status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeAll = mysql_fetch_row($result);
	$gradeAll = $gradeAll[0];	

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='not set' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeNS = mysql_fetch_row($result);
	$gradeNS = $gradeNS[0];
	
	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='A' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeA = mysql_fetch_row($result);
	$gradeA = $gradeA[0];

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='B' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeB = mysql_fetch_row($result);
	$gradeB = $gradeB[0];

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='C' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeC = mysql_fetch_row($result);
	$gradeC = $gradeC[0];

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='D' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeD = mysql_fetch_row($result);
	$gradeD = $gradeD[0];	

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='E' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeE = mysql_fetch_row($result);
	$gradeE = $gradeE[0];

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='F' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeF = mysql_fetch_row($result);
	$gradeF = $gradeF[0];

	$query = "SELECT COUNT(*) FROM grades WHERE ects_grade='FX' AND status IN ('grade', 'failed')";
	$result = mysql_query($query) OR die("SQL Server offline? - Error #25 - SQL-Message: " . mysql_error());
	$gradeFX = mysql_fetch_row($result);
	$gradeFX = $gradeFX[0];
// Some data
$data = array($gradeA,$gradeB,$gradeC,$gradeD,$gradeE,$gradeF,$gradeFX, $gradeNS, ($gradeAll-$gradeA-$gradeB-$gradeC-$gradeD-$gradeE-$gradeF-$gradeFX-$gradeNS));

// Create the Pie Graph.
$graph = new PieGraph(600,400,"auto");
//$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("ECTS Grades");
$graph->title->SetFont(FF_VERDANA,FS_BOLD,18); 
$graph->title->SetColor("darkblue");
$graph->legend->Pos(0.1,0.2);

// Create 3D pie plot
$p1 = new PiePlot3d($data);
$p1->SetTheme("sand");
$p1->SetCenter(0.4);
$p1->SetSize(170);

// Adjust projection angle
$p1->SetAngle(45);

// Adjsut angle for first slice
$p1->SetStartAngle(45);

// Display the slice values
$p1->value->SetFont(FF_ARIAL,FS_BOLD,11);
$p1->value->SetColor("navy");

// Add colored edges to the 3D pie
// NOTE: You can't have exploded slices with edges!
$p1->SetEdge("navy");

$p1->SetLegends(array("A","B","C","D","E","F","FX","not set","other"));

$graph->Add($p1);
$graph->Stroke();

?>


