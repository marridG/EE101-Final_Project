<!DOCTYPE html> 
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="/EE101-Final_Project/Final_Project/simple-.css">
<link rel="stylesheet" type="text/css" href="/EE101-Final_Project/Final_Project/index_search_advanced.css">
<!-- <link rel="stylesheet" type="text/css" href="/EE101-Final_Project/Final_Project/add-ons/bootstrap/button.css"> -->
<script type="text/javascript" src="/EE101-Final_Project/Final_Project/add-ons/jquery/jquery-3.4.0.min.js"></script>
<script src="/EE101-Final_Project/Final_Project/add-ons/01_Scroll_Page_to_Original.js"></script>
<link href='http://cdn.webfont.youziku.com/webfonts/nomal/129558/45817/5cecef5bf629d80af8efaac6.css' rel='stylesheet' type='text/css' />
<!-- 	ChannelSlanted2的link -->


<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


<head>
	<title>Advanced Search</title>
</head>

<body><!-- Advanced Search -->

	<style>
	.navbar-brand
	{
		font-family: 书体坊兰亭体;
		src: url("/EE101-Final_Project/Final_Project/font/书体坊兰亭体I.ttf");
		margin: -20px 0 5px 0;
		vertical-align: 10%;
		float: left;
		width: 50px;
		height: 100px;
		font-size:60px;
	}
	body
	{
		background-color: #f9e9c3;
	}
	</style>
<nav class="nav navbar-default navbar-fixed-top" style="height: 80px;margin: 0 0 5% 0;" role="navigation">
    <div class="navbar-header">
        <a href="/EE101-Final_Project/Final_Project/index.php" class="navbar-brand" style="margin: 1% 0 -2% 0;">Phantom</a>
    </div>
    <div>
        <ul class="nav nav-right" style="margin: -1% 0 0 50%;">
        	<li style="display: inline;margin: 0 0 0 70%;"><h1 style="font-family: ChannelSlanted2;font-size: 140%">Your Best Academia Database!</h1></li>
</nav>

<div onscroll="SetH(this)">

<!-- 	<div id="advanced_search_head">
		<a href="/EE101-Final_Project/Final_Project/index.php"> <img src="/EE101-Final_Project/Final_Project/pics/phantom.png" id="acemap"></a>	
		<h1 >Your Best Academia Database!</h1>
	</div> -->

	<script type="text/javascript">
		function show_boxes(add_del)	// change show boxes request
		{
			// var add_del=1;
			var xmlhttp;
			if (window.XMLHttpRequest)	//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
				xmlhttp=new XMLHttpRequest();
			else	// IE6, IE5 浏览器执行代码
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("advanced_boxes_root").innerHTML=xmlhttp.responseText;
					// document.getElementById("advanced_search_hide_show").style.height=$(".advanced_ancestor")[0].scrollHeight+'px';
				}
			}
			
			// (1) show del_box button
			// (2) get url and GET
			var url="/EE101-Final_Project/Final_Project/add-ons/07_advanced_search_boxes.php?add_del="+add_del;
			var elements_boxes=$(".advanced_box");
			var i=0;

			// change delete_box button display status
				if(add_del=="1")
					document.getElementById("advanced_search_del_box").style.display="inline";
				else if(elements_boxes.length=="2")
					document.getElementById("advanced_search_del_box").style.display="none";

			// get url
				if(elements_boxes.length>=1)
				{
					var box_children=$(".advanced_box")[0].childNodes;
					// console.log(box_children);
					url=url+"&bool1="+box_children[0].value+"&target1="+box_children[1].value+"&word1="+box_children[3].value.replace(/ /g, "+");
					// console.log(box_children[3].value);
					// console.log(box_children[3].value=="");
					// console.log(box_children[3].value=="undefined");
					// console.log(!box_children[3].value);
					for (i=1;i<=elements_boxes.length-1;i++)
					{
						box_children=$(".advanced_box")[i].childNodes;
						url=url+"&bool"+(i+1)+"="+box_children[0].value+"&target"+(i+1)+"="+box_children[2].value+"&word"+(i+1)+"="+box_children[4].value.replace(/ /g, "+");
					} 
					var count=elements_boxes.length;
					// console.log(count);
					url=url+"&count="+count;
				}
				else
				{
					url=url+"&count=0";
				}
				// console.log(url);

			// request
				xmlhttp.open("GET",url, true);
				xmlhttp.send();
		}

		function submit_search(page,whether_turn_page)	// submit search request
		{
			var xmlhttp;
			if (window.XMLHttpRequest)	//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
				xmlhttp=new XMLHttpRequest();
			else	// IE6, IE5 浏览器执行代码
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					if(!whether_turn_page)
						$("#advanced_search_hide_show")[0].onclick();
					$("#advanced_search_hide_show")[0].style.display="block";
					document.getElementById("advanced_search_result").innerHTML=xmlhttp.responseText;
					var num_max=document.getElementById("advanced_search_result_num_max").value;
					var page_limit;
					var min_page;
					var max_page;
					var page_MAX;
					if(num_max!=0)
					{
						// alert("not null");
						page_limit=document.getElementById("advanced_search_result_page_limit").value;
						page_MAX=document.getElementById("advanced_search_result_page_MAX").value;
					}
					// if(page==1)
						turn_page(num_max,page_limit,page);
				}
			}

			// get url and GET
			var url="/EE101-Final_Project/Final_Project/add-ons/07_search_advanced.php?page="+page;
			var elements_boxes=$(".advanced_box");
			var i=0;
			if(elements_boxes.length>=1)
			{
				var box_children=$(".advanced_box")[0].childNodes;
				if(!box_children[3].value)
				{
					alert("Pleae fill in the 1-st blank.");
					return;
				}
				url=url+"&bool1="+box_children[0].value+"&target1="+box_children[1].value+"&word1="+box_children[3].value.replace(/ /g, "+");
				for (i=1;i<=elements_boxes.length-1;i++)
				{
					box_children=$(".advanced_box")[i].childNodes;
					url=url+"&bool"+(i+1)+"="+box_children[0].value+"&target"+(i+1)+"="+box_children[2].value+"&word"+(i+1)+"="+box_children[4].value.replace(/ /g, "+");
					// console.log(i+" "+box_children[4].value+" "+!box_children[4].value);
					// console.log("---END---")
					if(!box_children[4].value)
					{
						if(i+1==2)
							alert("Pleae fill in the 2-nd blank.");
						else if(i+1==3)
							alert("Pleae fill in the 3-rd blank.");
						else
							alert("Pleae fill in the "+(i+1)+"-th blank.");
						return;
					}
				} 
				var count=elements_boxes.length;
				// console.log(count);
				url=url+"&count="+count;
			}
			else
			{
				url=url+"&count=0";
			}
			// console.log("search!:\n"+url);

			// request
			xmlhttp.open("GET",url, true);
			xmlhttp.send();
		}

		function turn_page(num_max,page_limit,page)	// show turn page
		{
			var page_MAX;
			var min_page;
			var max_page;
			// Calculate page_MAX, min_page, max_page
				if(num_max%page_limit==0)
					page_MAX=num_max/page_limit;
				else
					page_MAX=Math.floor(num_max/page_limit)+1;
				if(num_max<=90)
				{
					min_page=1;
					if(num_max%page_limit==0)
						max_page=num_max/page_limit;
					else
						max_page=Math.floor(num_max/page_limit)+1;
				}
				else
				{
					min_page=page-5;
					while(min_page<1)
						min_page++;
					max_page=min_page+9;
					while((max_page-1)*page_limit>=num_max)
						max_page--;
					if(max_page-min_page+1<10)
						min_page=max_page-9;
				}
				
			// console.log(num_max,page_limit,page_MAX,min_page,max_page,page);
			if(num_max==0)
			{
				document.getElementById("advanced_search_result_turn_page").innerHTML="";
				return;
			}

			var xmlhttp;
			if (window.XMLHttpRequest)	//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
				xmlhttp=new XMLHttpRequest();
			else	// IE6, IE5 浏览器执行代码
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("advanced_search_result_turn_page").innerHTML=xmlhttp.responseText;
				}
			}

			// get url and GET
			var url="/EE101-Final_Project/Final_Project/add-ons/07_advanced_search_pages.php?num_max="+num_max+"&page_limit="+page_limit+"&page_MAX="+page_MAX+"&min_page="+min_page+"&max_page="+max_page+"&page="+page;
			// console.log("page\n"+url);

			// request
			xmlhttp.open("GET",url, true);
			xmlhttp.send();
		}

		function jump_to_submit()	// submit jump to page
		{
			var page_MAX=Math.floor(document.getElementById("advanced_search_result_page_MAX").value);
			var new_page=Math.floor(document.getElementsByName("advanced_search_page")[0].value);
			console.log(new_page);
			if(new_page=="")
			{
				alert("Please enter the new page number.");
				return;
			}
			if(new_page>page_MAX || new_page<0)
			{
				alert("Page Number Overflow.");
				return;
			}
			submit_search(new_page,1);
		}

	</script>
	
	<div class="advanced_ancestor">
		<br>

		<div id="advanced_search_rows_add_del"><br>
		
		<!-- boxes -->
		<div id="advanced_boxes_root">
			<!-- initial box -->
			<div class="advanced_box">
				<select id="advanced_search_target_select">
					<option value ="Title" selected>Title</option>
					<option value ="Authors_Name">Author</option>
					<option value ="ConferenceName">Conference</option>
				</select>
				&nbsp;
				<input type="text" id="advanced_search_word_input_text" required>
			</div>
		</div>
		<br>
		
		<div id="advanced_search_add_del_box">
			<!-- add -->
			<button id="advanced_search_add_box" onclick="show_boxes(1)">+</button>
			&nbsp;&nbsp;
			<!-- delete -->
			<button id="advanced_search_del_box" onclick="show_boxes(0)">-</button>
		</div>

		</div>
		
		<!-- submit -->
		<br><br>
		<button id="advanced_search_submit" onclick="submit_search(1,0)"><img src="/EE101-Final_Project/Final_Project/pics/search-noBK.jpg" id="advanced_search_submit_image"></button>

	</div>

	<!-- <div id="advanced_search_hide_show"> -->
		<button id="advanced_search_hide_show"><<</button>
	<!-- </div> -->

	<div id="advanced_search_result_ancestor">
		<!-- <img src="/EE101-Final_Project/Final_Project/pics/advanced_BK.jpg" id="advanced_search_default_result_image"> -->
		<!-- result -->
		<div id="advanced_search_result"></div>
		<!-- turn page -->
		<div id="advanced_search_result_turn_page"></div>
	</div>
</div>

	<!-- show or hide the search boxes -->
	<script type="text/javascript" src="/EE101-Final_Project/Final_Project/add-ons/07_show_hide.js"></script>

</body>
</html>