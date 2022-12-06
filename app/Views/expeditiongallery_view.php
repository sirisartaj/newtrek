<!DOCTYPE html>
<html>
	<head> 
		<title>Gallery</title>
		<link rel="stylesheet" type="text/css" href="<?php echo baseURL1;?>/css/dropzone.css">
		<link rel="stylesheet" type="text/css" href="<?php echo baseURL1;?>/css/dropzone.min.css">
		<script type="text/javascript" src="<?php echo baseURL1;?>/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="<?php echo baseURL1;?>/js/jquery-ui-1.11.2.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#"  class="btn btn-primary show-tooltip clearr m-r-10" id="clearr" style="display:none" title="Clear Dropzone"><i class="icon-cloud-clear"></i> Clear Dropzone</a>
            <a href="#" class="btn btn-primary show-tooltip pull-right" title="Upload new images" id="upload-dropzone"><i class="icon-cloud-upload"></i>Upload Images</a>
            <div class="row m-b-10">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="upload-dropzone-area" >
                  <div  id="assignment-dropzone" action="<?php echo base_url('/addExpgallerydetails/'.$expedition_id);?>" class="dropzone dropzone-upload">
                    <div class="fallback">
                      <input name="image" type="file"  multiple />
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="mask"></div>
              <div class="uploaded-images">
              	<hr>
                <ul class="gallery" id="gallery">
	                <?php foreach ($galleryImages->gallery_image as $images) { ?>
	                  <li class="sortable" id="photoid_<?php echo $images->imageId;?>">
	                    <a href="#" class="animal effect-zoe magnific" data-mfp-src="<?php echo $images->imageName;?>">
	                    <img width="766" src="<?php echo $images->imageName;?>" alt="no image" />
	                    </a>
	                    <?php $onlyname = end(explode('/', $images->imageName));?>
	                    <div class="gallery-tools"  >
	                      <div id="<?php echo $images->imageId;?>" title="Delete<?php echo $images->imageName;?>" url=""  class="delete btn btn-danger" onclick="deletegallery('<?php echo $images->imageId;?>','<?php echo $onlyname;?>');"><i class="icon-trash"></i>X
	                      </div>
	                    </div>
	                    
	                  </li>
	                  <?php } ?>   
                </ul>
              </div>
          </div>
        </div>
		</div>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
		<script> 
			//$(document).ready(function(){
				 $("#assignment-dropzone").dropzone({  
      "maxFilesize": 20
    });
				Dropzone.autoDiscover = false;
			  $(".dropzone").hide();
			 // $("#upload-dropzone").click(function(){
			    $(".dropzone").slideToggle('slow');
			  //});
			//});
			function deletegallery(id,name){
				console.log(id);
				Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {
				  	$.ajax({				      
				      method: "POST",
				      url: '<?php echo base_url()."/galleryimagedelete";?>',
				      data: {'id':id,'image_name':name},
				      success: function(result1) {
				      	console.log(result1);
				      	location.reload();
				      	 
				      }
				    });
				    
				  }
				})
			}
			
		</script>

		<script> 
			$(".dropzone").click(function(){
			    $(".clearr").show();
			});
		    $(".clearr").click(function(){
			    $(".dropzone").animate({
			            height: 'toggle'
			    });
		        window.location.reload();			   
			});
		</script>
		<script type="text/javascript" src="<?php echo baseURL1;?>/js/dropzone.min.js"></script>

	</body>
</html>