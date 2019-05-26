<!DOCTYPE html> 
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/EE101-Final_Project/Final_Project/simple-.css">
<head>
	<title>Conference</title>
</head>

<body>
	<img src="">
	<h1>Conference Information</h1>

	<?php
	// from search.php: get conference_name

	function Turn_Page_min_max_page($num_max,$page_limit,&$min_page,&$max_page,$page)
	{
		if($num_max<=90)
		{
			$min_page=1;
			if($num_max%$page_limit==0)
				$max_page=$num_max/$page_limit;
			else
				$max_page=floor($num_max/$page_limit)+1;
		}
		else
		{
			$min_page=$page-5;
			while($min_page<1)
				$min_page++;
			$max_page=$min_page+9;
			while(($max_page-1)*$page_limit>=$num_max)
				$max_page--;
			if($max_page-$min_page+1<10)
				$min_page=$max_page-9;
		}
		// var_dump($min_page);
		// var_dump($max_page);
	}





	$conference_name = $_GET["conference_name"];


			echo "<a name=\"skip_conference\"></a>";
			echo "Conference Name: ".$conference_name;

			$ch = curl_init();
			$timeout = 5;
			$query = urlencode($conference_name);
			// $query = urlencode(str_replace(' ', '+', $author_name));
			$url = "http://localhost:8983/solr/lab02/select?indent=on&q=ConferenceName:".$query."&wt=json";

			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$result = json_decode(curl_exec($ch), true);
			curl_close($ch);


			if($result['response']['docs'])
			{

				echo "<table class=\"table__result\"><tr><th>Title</th><th>Authors</th><th>Conference</th></tr>";
			// print the result table
				foreach ($result['response']['docs'] as $paper)
				{
					// new line
					echo "<tr>";
					// print the Title
						echo "<td>";
						$title_new=$paper['Title'];
						echo "<a href=\"/EE101-Final_Project/Final_Project/title.php?title=$title_new&page=1\" target=\"_balnk\">$title_new</a>";
						echo ";";
						echo "</td>";

					// print all the Authors_Name
						echo "<td>";
						foreach ($paper['Authors_Name'] as $idx => $author)
						{
							$author_id = $paper['Authors_ID'][$idx];
							echo "<a href=\"/EE101-Final_Project/Final_Project/author.php?author_id=$author_id&page=1\" target=\"_balnk\">$author</a>";
							echo "; ";
						}
						echo "</td>";

					// print ConferenceName
						echo "<td>";
						$conference_name=$paper['ConferenceName'];
						echo "<a href=\"/EE101-Final_Project/Final_Project/conference.php?conference_name=$conference_name&page=1\" target=\"_balnk\">$conference_name</a>";
						echo ";";
						echo "</td>";
					echo "</tr>";
				}
				echo "</table><br>";



		// $paper_title = $paper['Title'];
		// $author_name = $paper['Authors_Name'];
		// $conference_name = $paper["ConferenceName"];



		$page = $_GET["page"];
		// }
		// var_dump($page_title);
		// var_dump($page_author);
		// var_dump($page_conference);
		// $paper_title_temp = urlencode($paper_title);
		// $author_name_temp = urlencode($author_name);
		$conference_name_temp = urlencode($conference_name);




			// // Turn Page
			// 	$num_max=$result["response"]["numFound"];
			// 	Turn_Page_min_max_page($num_max,$page_limit,$min_page,$max_page,$page_conference);
			// 	echo "Found $num_max results.&nbsp;&nbsp;&nbsp;&nbsp;Each page: $page_limit items.<br>";
			// 	echo "<table class=\"table__Turn_Page\">";
			// 	echo "<tr>";
			// 	// Row One
			// 		// Previous Page
			// 		echo "<td>";
			// 		$i=$page-1;
			// 		if($i>=1)
			// 		{
			// 			echo "<a href=\"conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\"></a>";
			// 			echo "</td><td>";
			// 			echo "<a href=\"conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_prev.jpg\" id=\"search__Turn_Page_prev_page\"></a>";

			// 		}
			// 		else
			// 		{
			// 			echo "<img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\">";
			// 			echo "</td><td>";
			// 			echo "<img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_prev.jpg\" id=\"search__Turn_Page_prev_page\">";
			// 		}
			// 		echo "</td>";
			// 		// Pages in the middle
			// 		for($i=$min_page;$i<=$max_page;$i++)
			// 		{
			// 			if($i==$page_conference)
			// 				echo "<td><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_selected.jpg\" id=\"search__Turn_Page_selected\"></a></td>";
			// 			else
			// 				echo "<td><a href=\"conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_not_selected.jpg\"  id=\"search__Turn_Page_not_selected\"></a></td>";
			// 		}
			// 		// Next Page
			// 		echo "<td>";
			// 		$i=$page_conference+1;
			// 		if (($i-1)*$page_limit<$num_max)
			// 		{
			// 			echo "<a href=\"conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\" id=\"search__Turn_Page_prev_page\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_next.jpg\" id=\"search__Turn_Page_next_page\"></a>";
			// 			echo "</td><td>";
			// 			echo "<a href=\"conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\" id=\"search__Turn_Page_prev_page\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\"></a>";
			// 		}
			// 		else
			// 		{
			// 			echo "<img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_next.jpg\" id=\"search__Turn_Page_next_page\">";
			// 			echo "</td><td>";
			// 			echo "<img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\">";
			// 		}
			// 		echo "</td>";
			// 	echo "</tr>";
			// 	echo "<tr>";
			// 	// Row Two
			// 		// Turn to the Previous Page
			// 		$i=$page_conference-1;
			// 		echo "<td>";
			// 		if ($i>=1)
			// 		{
			// 			echo "<a href=\"/EE101-Final_Project/Final_Project/conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><<</a>";
			// 			echo "</td><td>";
			// 			echo "<a href=\"/EE101-Final_Project/Final_Project/conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\"></a>";
			// 		}
			// 		else
			// 			echo "<td></td>";
			// 		echo "</td>";
			// 		// Show Page Numbers
			// 		for($i=$min_page; $i <= $max_page; $i++)
			// 		{ 
			// 			echo "<td>";
			// 			if($i==$page_conference)
			// 				echo "$page_conference";
			// 			else
			// 				echo "<a href=\"/EE101-Final_Project/Final_Project/conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\">$i</a>";
			// 			echo "</td>";
			// 		}
			// 		// Turn to the Next Page
			// 		echo "<td>";
			// 		$i=$page_conference+1;
			// 		if (($i-1)*$page_limit<$num_max)
			// 		{
			// 			echo "<a href=\"/EE101-Final_Project/Final_Project/conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\"><img src =\"/EE101-Final_Project/Final_Project/pics/Turn_Page_empty.jpg\" id=\"search__Turn_Page_empty\"></a>";
			// 			echo "</td><td>";
			// 			echo "<a href=\"/EE101-Final_Project/Final_Project/Conference.php?paper_title=$paper_title_temp&author_name=$author_name_temp&conference_name=$conference_name_temp&page_title=$page_title&page_author=$page_author&page_conference=$i#skip_conference\">>></a>";
			// 		}
			// 		else
			// 			echo "<td></td>";
			// 		echo "</td>";
			// 	echo "</tr>";
			// 	echo "</table>";

			// 	// Jump to Page
			// 	echo "<form id=\"form__jump_to__right_hand\" action=\"/EE101-Final_Project/Final_Project/search.php#skip_conference\">";
			// 	echo "<input type=\"hidden\" name=\"paper_title\" value=\"$paper_title\"><input type=\"hidden\" name=\"author_name\" value=\"$author_name\"><input type=\"hidden\" name=\"conference_name\" value=$conference_name><input type=\"hidden\" name=\"page_title\" value=$page_title><input type=\"hidden\" name=\"page_author\" value=$page_author>";
			// 	echo "Jump to: <input type=\"number\" name=\"page_conference\" size=\"1\" max=100000>&nbsp;&nbsp;";
			// 	echo "<input type=\"submit\" value=\"Go!\"></form>";
			// 	// var_dump($page_conference);

			// 	echo "<br><br><br>";
			}












