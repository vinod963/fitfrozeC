<div class="col-md-9 total-news">		
	<div class="posts">
		<div class="left-posts">
			<div class="gallery">
				<div class="main-title-head">
					<h3>Your Ringtone</h3>					
					<div class="clearfix"></div>
				</div>
				<div class="tech-news-grids">
					<div class="custom_upload_div">						
						<div class="row">
							<div class="col-md-3">
								<!-- The jPlayer div must not be hidden. Keep it at the root of the body element to avoid any such problems. -->
								<div id="jquery_jplayer_1" class="cp-jplayer"></div>					
								<!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->
					
								<div id="cp_container_1" class="cp-container" >
									<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
										<div class="cp-buffer-1"></div>
										<div class="cp-buffer-2"></div>
									</div>
									<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
										<div class="cp-progress-1"></div>
										<div class="cp-progress-2"></div>
									</div>
									<div class="cp-circle-control"></div>
									<ul class="cp-controls">
										<li><a class="cp-play" tabindex="1">play</a></li>
										<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
									</ul>
								</div>	
							</div>						
												
						</div>						  																		
					</div>				
					<div class="clearfix"></div>
				</div>
			</div>
		
		</div>		
		<div class="clearfix"></div>	
	</div>
</div>


<script type="text/javascript">
	document.addEventListener( "DOMContentLoaded", function(){
			
		$(function() {		
			var myCirclePlayer = new CirclePlayer("#jquery_jplayer_1",
					{
						mp3: "<?php echo $row[0]['mp3ringtone']?>",						
					}, {
						supplied: "mp3",
						cssSelectorAncestor: "#cp_container_1",
						swfPath: "/assets/css/jplayer/skin",
						wmode: "window",
						keyEnabled: true
					});
				  	
		});	

	});	
</script>

<style>
	.custom_step{
		font-family: 'bebasregular';
	}
	.btn-file {
	    position: relative;
	    overflow: hidden;
	}
	.btn-file input[type=file] {
	    position: absolute;
	    top: 0;
	    right: 0;
	    min-width: 100%;
	    min-height: 100%;
	    font-size: 100px;
	    text-align: right;
	    filter: alpha(opacity=0);
	    opacity: 0;
	    outline: none;
	    background: white;
	    cursor: inherit;
	    display: block;
	}
	.btn {
	    padding: 6px 12px; 
	     background: #337ab7; 
	}
	.btn:hover {
	    background: #286090;
	}

</style>