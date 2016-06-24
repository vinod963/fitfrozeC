<div class="col-md-9 total-news">		
	<div class="posts">
		<div class="left-posts">
			<div class="gallery">
				<div class="main-title-head">
					<h3>Make your ringtone</h3>					
					<div class="clearfix"></div>
				</div>
				<div class="tech-news-grids">
					<div class="custom_upload_div table-responsive">						
						<div id="uploadbox">							
							 <form id="uploadform" name="uploadform" method=""  enctype="multipart/form-data">							  	    
						       <div align="center">
						       		<h3 class="custom_step">STEP 1</h3>
						      		<div id="loading" style="display: none;"><img src="/images/loading.png"><br><b>Loading Please Wait...</b>
						        	<br>This may take a few minutes.</div>
						       </div>	<br>						   
							   <div align="center">
							   		<strong>Select your mp3 file that you need to convert ringtone </strong>
							   	</div>
							   	<br>
							   	<div align="center">							        
							         <div class="col-12">
							            <label class="btn btn-block btn-primary">
							                Browse&hellip; <input id="fileToUpload" type="file" name="fileToUpload" style="display: none;">
							            </label>          						            
							        </div>  								
							    </div>
							    <br>							 				   
							</form>
						</div>						  																		
					</div>				
					<div class="clearfix"></div>
				</div>
			</div>
		
		</div>		
		<div class="clearfix"></div>	
	</div>
</div>
<script>

	document.addEventListener( "DOMContentLoaded", function(){
	
		$(function() {
		  // We can attach the `fileselect` event to all file inputs on the page
		  $(document).on('change', ':file', function() {
		    var input = $(this),
		        numFiles = input.get(0).files ? input.get(0).files.length : 1,
		        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		    input.trigger('fileselect', [numFiles, label]);
		  });

		  // We can watch for our custom `fileselect` event like this
		  $(document).ready( function() {
		      $(':file').on('fileselect', function(event, numFiles, label) {

		          var input = $(this).parents('.input-group').find(':text'),
		              log = numFiles > 1 ? numFiles + ' files selected' : label;

		          if( input.length ) {
		              input.val(log);
		          } else {
		              //if( log ) alert(log);
		          }

		      });	      	
		  });  	
	
		  
			function applyAjaxFileUpload(element) {
				$(element).AjaxFileUpload({
					action: "/ringtones/ownringtone/ajaxFileUpload",
					onChange: function(filename) {	
						$(element).prop('disabled',true);			
						// Create a span element to notify the user of an upload in progress
						$("#loading").show();					
					},				
					onComplete: function(filename, response) {
			
						if (typeof(response.error) === "string") {
							alert(response.error);
						}
						else{
							//$("#loading").hide();
							$('#uploadbox').html('<iframe src="' + response.cutterurl + '"></iframe>');										
						}													
						$("#loading").hide();
					}
				});
				return false;
			}

			applyAjaxFileUpload("#fileToUpload");	  
		  
		});		
	});	
</script>