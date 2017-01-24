<?php
require_once 'dependencies/Mobile_Detect.php';
	$detect = new Mobile_Detect;
	$criteriaArray = isset($_GET["criteriaarray"]) ? json_decode($_GET["criteriaarray"]) : null;
	$yeargroupArray = isset($_GET["yeargrouparray"]) ? json_decode($_GET["yeargrouparray"]) : null; 
	if($detect->isMobile() && !$detect->isTablet())
	{
		echo '<link href="css/mobilestyle.css" type="text/css" rel="stylesheet"/>';
	}
	else
	{
		echo '<link href="css/style.css" type="text/css" rel="stylesheet"/>';
	}
	if(!isset($_SESSION))
	{
		session_start();
	}
	$signInPage = isset($_SESSION["signinpage"]) ? $_SESSION["signinpage"] : null;
	if($signInPage == true)
	{
		require_once "databaseView.php";
	}
	else
	{
		require_once "database.php";
	}
	$database = new MeekroDB("localhost", "root", "", "users");
	date_default_timezone_set("Europe/London");
	$userLevel = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : null;
	$names = DB::query('SELECT * FROM names ORDER BY Yeargroup ASC, Surname');
	$studentCardArray = [];
	$lastYearGroup = "Third Form";
	$nickname = "";
	$studentCount = 0;
	foreach($names as $person)
	{
		if($criteriaArray != null && $yeargroupArray != null)
		{
			if(in_array(htmlspecialchars($person["Location"]), $criteriaArray))
				{
					if(in_array($person["Yeargroup"], $yeargroupArray))
					{
					$studentCardArray[] = new StudentCard($person["ID"], $person["Firstname"], $person["Surname"], $person["Yeargroup"], $person["Nickname"], $person["Location"]);
					}
				}
		}
		else if($criteriaArray != null)
			{
				if(in_array(htmlspecialchars($person["Location"]), $criteriaArray))
				{
					$studentCardArray[] = new StudentCard($person["ID"], $person["Firstname"], $person["Surname"], $person["Yeargroup"], $person["Nickname"], $person["Location"]);
				}
			}
		else if($yeargroupArray != null)
			{
				if(in_array($person["Yeargroup"], $yeargroupArray))
				{
					$studentCardArray[] = new StudentCard($person["ID"], $person["Firstname"], $person["Surname"], $person["Yeargroup"], $person["Nickname"], $person["Location"]);
				}
			}
		else if($yeargroupArray == null && $criteriaArray == null)
			{
				$studentCardArray[] = new StudentCard($person["ID"], $person["Firstname"], $person["Surname"], $person["Yeargroup"], $person["Nickname"], $person["Location"]);
			}
		$studentCount++;
	}
		$row = $database->queryFirstRow("SELECT * FROM houselist WHERE House=%s", DB::$dbName);
	$database->update("houselist", array("StudentCount" => $studentCount), "House=%s", DB::$dbName);
	echo '<div>';
	foreach($studentCardArray as $studentCard)
	{
		if($signInPage == true)
		{
			$studentCard->draw("Student", $detect);
		}
		else
		{
			$studentCard->draw($userLevel, $detect);
		}

		//$lastYearGroup = $studentCard->getYeargroup();
	}
	echo '</div>';

	class StudentCard
	{
		public $id;
		public $firstname;
		public $surname;
		public $yeargroup;
		public $shortYeargroup;
		public $timeLastOut;
		public $date;
		public $time;
		public $nickname;
		public $location;
		function __construct($dId, $dFirstname, $dSurname, $dYeargroup, $dNickname, $dLocation)
		{
			$this->id = $dId;	
			$this->firstname = $dFirstname;
			$this->surname = $dSurname;
			$this->shortYeargroup = $dYeargroup;
			$this->location = ucfirst(htmlspecialchars_decode($dLocation));
			switch($dYeargroup)
			{
				case "3rd":
					$this->yeargroup = "Third Form";
					break;
				case "4th":
					$this->yeargroup = "Fourth Form";
					break;
				case "5th":
					$this->yeargroup = "Fifth Form";
					break;
				case "LVIth":
					$this->yeargroup = "Lower Sixth";
					break;
				case "UVIth":
					$this->yeargroup = "Upper Sixth";
					break;
			}
			if(strcmp($dNickname,"") == 0)
			{
				$this->nickname = "<br/>".htmlspecialchars_decode($dNickname)."";
			}
			else
			{
				$this->nickname = "<br/>(".htmlspecialchars_decode($dNickname).")";
			}	
		}
		function getYeargroup()
		{
			echo $this->yeargroup;
		}

		function draw($levelAccess, $detect)
		{
			$this->setTimestamp();
			$class = "name";
			echo '<div id="base'.$this->id.'" class="basename '.$class.'">';
			echo '<div class="namelink" id="'.$this->id.'" onclick="updateSelection('.$this->id.')"><div class="namelinktop">';
			echo '<span class="glyphicon glyphicon-ok selected" aria-hidden="true" style="visibility: hidden;" id="selected'.$this->id.'"></span>';
			if(strcmp($levelAccess,"HM") == 0 || strcmp($levelAccess,"ADMIN") == 0 || strcmp($levelAccess, "Tutor") == 0)
			{
			if(strcmp($levelAccess,"HM") == 0 || strcmp($levelAccess,"ADMIN") == 0 )
			{
				echo '<br/><a href="editstudent.php?id='.$this->id.'" class="editlinks"><span class="glyphicon glyphicon-edit"></span></a>';
				echo '<br/><a data-toggle="modal" href="#deletemodal'.$this->id.'" class="deletelinks"><span class="glyphicon glyphicon-trash"></span></a>';
				
			}
			echo '<br/><p class="datetime time">'.$this->time.'</p>';
				echo '<br/><p class="datetime date">'.$this->date.'</p>';
			}
			
			echo '</div><div class="namelinkcontent" ><p id="name'.$this->id.'" >'.htmlspecialchars_decode($this->firstname).'<br/> '.htmlspecialchars_decode($this->surname).$this->nickname.'</p></div>';
			echo '<div class="namelinkyeargroup"><p id="yeargroup'.$this->shortYeargroup.'">'.$this->yeargroup.'</p>';
			echo '<p id="location'.$this->id.'">'.$this->location.'</p></div>';
			echo '</div>';
			echo '</div>';
			if(strcmp($levelAccess,"HM") == 0 || strcmp($levelAccess,"ADMIN") == 0 )
			{
			echo '<div id="deletemodal'.$this->id.'" class="modal fade" role="dialog">
	  				<div class="modal-dialog">
	   					<div class="modal-content">
	     					<div class="modal-header">
	        					<button type="button" class="close" data-dismiss="modal">&times;</button>
	        				<h4 class="modal-title">Are you sure you would like to delete this student?</h4>
	      				</div>
	      			<div class="modal-body">
	        			<p>There is no recovering this when you delete it.</p>
	      			</div>
	      			<div class="modal-footer">
	      				<a class="btn btn-default" href="php/deletestudent.php?id='.$this->id.'" >Yes</a>
	        			<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	      			</div>
	    		</div>

	  			</div>
				</div>';
			}
		}
		function setTimestamp()
		{
			$this->timeLastOut = DB::queryFirstRow('SELECT * FROM history WHERE StudentFirstname="'.$this->firstname.'" AND StudentSurname="'.$this->surname.'" ORDER BY Timestamp DESC');
			$timestamp = new DateTime($this->timeLastOut["Timestamp"]);
			$this->date = $timestamp->format("d/M/y");
			$this->time = $timestamp->format("G:i");	
		}
	}

?>