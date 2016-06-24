<div class="col-md-9 total-news">

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en'>
<head>
	
	<title>Ringtone maker</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link type="text/css" href="/assets/css/jquery-ui.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/assets/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="/assets/js/jplayer/jquery.jplayer.min.js"></script>
	
	<style type="text/css">
	  .ui-slider-horizontal .ui-state-default {background:  url(/assets/css/images/slider_20x23.png) no-repeat scroll 50% 50%; border:0px;}
	  </style>
	
	<script type="text/javascript">
	document.addEventListener( "DOMContentLoaded", function(){
	$(document).ready(function() {
		$("#convertingResults").hide();
			$("#pressing").click(function() {$("#jquery_jplayer").jPlayer("stop");$("#slider_div").slideUp(function(){$("#convertingResults").slideDown();}); });
			$("#editAgain").click(function(){alert("test")});
	});
	function getQuerystring(key, default_)
	{
	  if (default_==null) default_="";
	  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
	  var qs = regex.exec(window.location.href);
	  if(qs == null)
	    return default_;
	  else
	    return qs[1];
	}
	<!--
	
	$(function(){
	
		var global_lp = 0;
		var global_lp = 0;
		var ppaMinimum=0;
		var ppaMaximum=500;
		var jpPlayTime = $("#jplayer_play_time"); 
	    var jpTotalTime = $("#jplayer_total_time");
	    var jpPlayTimeMili;
	    var jpPlayTotalMili;
		var song = getQuerystring('vid_name');
		var songname=getQuerystring('song_name');
		var sid = getQuerystring('id');
		
		
		
		//on press
		$('#pressing').click( function()
				{			
					$("#convertingResults").load('/ringtones/ownringtone/ffmpeg?min='+ppaMinimum + '&max=' +ppaMaximum + '&total='+jpPlayTotalMili + '&song='+song + '&song_name='+songname + '&id='+sid);
				});
		$("#jquery_jplayer").jPlayer({
			ready: function ()
			{
				this.element.jPlayer("setFile", song).jPlayer("play");
				showPauseBtn();
			},
			customCssIds: true
		})
		.jPlayer("onProgressChange", function(loadPercent,playedPercentRelative,playedPercentAbsolute,playedTime,totalTime) {
	 		var lpInt = parseInt(loadPercent);
	 		var ppaInt = parseInt(playedPercentRelative);
	 		jpPlayTime.text($.jPlayer.convertTime(playedTime)); 
	 		jpTotalTime.text($.jPlayer.convertTime(totalTime)); 
	        jpPlayTimeMili=parseInt(playedTime);
	        jpPlayTotalMili=parseInt(totalTime);
	 		global_lp = lpInt;
	 		$('#sliderPlayback').slider({
				range: true,
				step: 0.05,
				min: 0,
				max: 100,
				values: [ 0, 100 ],
	
			slide: function(event, ui) {
				//$("#jquery_jplayer").jPlayer("playHead", ui.value*(100.0/global_lp));
				$("#jquery_jplayer").jPlayer("playHead", ui.values[0]*(100.0/global_lp));
					
					ppaMaximum=ui.values[1];
					ppaMinimum=ui.values[0];
					
			}
		});
			//alert(global_lp);
			// load selected start
			if(ppaInt > ppaMaximum) {
				console.log(global_lp);
			 //$("#jquery_jplayer").jPlayer("stop");
			 $("#jquery_jplayer").jPlayer("playHead",ppaMinimum*(100.0/global_lp));
			//alert(" minimum: " +ppaMinimum + "maximum"+ppaMaximum ) ;
			}
		
	
			if(lpInt <100)
			{
			$('#loaderBar').progressbar('option', 'value', lpInt );
			}
			else {
			$('#loaderBar').progressbar('option', 'value', ppaInt);
	 		//$('#sliderPlayback').slider('option', 'value', ppaInt);
	 		
	 		
	 		
	 		
	 		
	 		}
		})
		.jPlayer("onSoundComplete", function() {
			this.element.jPlayer("play");
		});
		
		$("#pause").hide();
	
		function showPauseBtn()
		{
			$("#play").fadeOut(function(){
				$("#pause").fadeIn();
			});
		}
	
		function showPlayBtn()
		{
			$("#pause").fadeOut(function(){
				$("#play").fadeIn();
			});
		}
	
		function playTrack(t,n)
		{
			$("#jquery_jplayer").jPlayer("setFile", t).jPlayer("play");
	
			showPauseBtn();
	
			return false;
		}
	
		$("#play").click(function() {
			$("#jquery_jplayer").jPlayer("play");
			showPauseBtn();
			return false;
		});
	
		$("#pause").click(function() {
			$("#jquery_jplayer").jPlayer("pause");
			showPlayBtn();
			return false;
		});
	
		$("#stop").click(function() {
			$("#jquery_jplayer").jPlayer("stop");
			showPlayBtn();
			return false;
		});
	
	
		$("#volume-min").click( function() {
			$('#jquery_jplayer').jPlayer("volume", 0);
			$('#sliderVolume').slider('option', 'value', 0);
			return false;
		});
	
		$("#volume-max").click( function() {
			$('#jquery_jplayer').jPlayer("volume", 100);
			$('#sliderVolume').slider('option', 'value', 100);
			return false;
		});
	
		$("#player_progress_ctrl_bar a").live( "click", function() {
			$("#jquery_jplayer").jPlayer("playHead", this.id.substring(3)*(100.0/global_lp));
			return false;
		});
	
		
	
		$('#sliderVolume').slider({
			value : 50,
			max: 100,
			range: 'min',
			animate: true,
	
			slide: function(event, ui) {
				$("#jquery_jplayer").jPlayer("volume", ui.value);
			}
		});
	
		$('#loaderBar').progressbar();
	
	
		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);
	
	});
	});
	-->
	</script>
	
	
	<style>
	<!--
	
	#player_container {
		position:relative;
		border: 1px solid #009BE3;
		padding:20px;
		height:100px;
	}
	
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
	
	
	
	#sliderVolume {
		position:absolute;
		top:30px;
		left:480px;
		width:120px;
		height:.4em;
		
	}
	#sliderPlayback {
		height:100px;
		
	}
	#loaderBar {
		height:.4em;
		border:1px solid #dadada;
	}
	
	-->
	</style>
	
	<!--[if IE 6]>
	<link href="../css/ie6.css" rel="stylesheet" type="text/css" />
	<style>
	ul#icons #volume-min {
		margin:2px 130px 2px 216px;
	}
	
	#sliderVolume {
		width:110px;
		left:476px;
		height:.8em;
	}
	</style>
	
	<![endif]-->
	
	<!--[if IE 7]>
	<style>
	
	ul#icons #stop {
		margin-right:360px;
	}
	
	
	
	</style>
	
	<![endif]-->




</head>
<body>
	<center>
		<div id="slider_div" style="width:500px; height:200px; border:1px solid #cccccc; padding:5px; -moz-border-radius: 4px;-webkit-border-radius: 4px;">
			<div id="jquery_jplayer"></div>	
			<div id="player_container" style="border:0px">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li id="stop" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-stop"></span></li>
					<li id="play" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-play"></span></li>
					<li id="pause" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-pause"></span></li>
				</ul>
				<!-- Sliders -->
				
				<div id="bars_holder">
					<div id="loaderBar"></div>
					<div id="sliderPlayback"></div>					
					<ul id="icons" class="ui-widget ui-helper-clearfix">
						<li id="jplayer_play_time" style="font-family:Verdana; position:relative; font-size:10px; color:#999999; top:10px;"><li id="jplayer_total_time" style="font-family:Verdana; position:relative; font-size:10px; color:#999999; top:10px; float:right;"></li></li>					
					</ul>
				</div>				
			</div>   
	    	<div id="pressing" class="pressing"  style="float:right;font-family:Verdana;font-size:10px;   position:absolute; top:0px; ">OK, i'm finished</div>
		</div>
		<div id="convertingResults" style="width:670px; height:90px; border:1px solid #cccccc; padding:3px; -moz-border-radius: 4px;-webkit-border-radius: 4px;"></div>
	</center>
</body>
</html>
</div>
