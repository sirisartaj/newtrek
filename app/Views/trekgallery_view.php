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
		<style type="text/css">
			.gallery-tools {
  width: 766px;
  /*border-radius: 25px;*/
  border: 2px solid #ccc;
  padding: 15px 15px 15px 15px;
  margin: 20px 20px 20px 20px;
  background: #A4D3EE;
  overflow: visible;
  box-shadow: 5px 5px 2px #888888;
  position: relative;
}

.delete {
    position: absolute;
    background: red;
    color: white;
    top: -10px;
    right: -10px;
    padding: 5px;
    border-radius: 7px;
}
.gallery{
	list-style: none;
}
			
		</style>
		<div class="container">
			<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#"  class="btn btn-primary show-tooltip clearr m-r-10" id="clearr" style="display:none" title="Clear Dropzone"><i class="icon-cloud-clear"></i> Clear Dropzone</a>
            <a href="#" class="btn btn-primary show-tooltip pull-right" title="Upload new images" id="upload-dropzone"><i class="icon-cloud-upload"></i>Upload Images</a>
            <div class="row m-b-10">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="upload-dropzone-area" >
                  <div  id="assignment-dropzone" action="<?php echo base_url('/addgallerydetails/'.$trek_id);?>" class="dropzone dropzone-upload">
                    <div class="fallback">
                      <input name="image" type="file"  multiple />
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="mask"></div>
              <div class="container uploaded-images">
              	<hr>
                <div class="gallery" id="gallery" style="list-style: none;">
	                <?php foreach ($galleryImages->gallery_image as $images) { ?>
	                  <div class="sortable" id="photoid_<?php echo $images->imageId;?>">
	                    

	                    <div class="gallery-tools"  >
	                    	<?php $onlyname = end(explode('/', $images->imageName));?>
	                      <div id="<?php echo $images->imageId;?>" title="Delete<?php echo $onlyname;?>" url=""  class="delete btn btn-danger" onClick="deletegallery('<?php echo $images->imageId;?>','<?php echo $onlyname;?>');"><i class="icon-trash"></i>X
	                      </div>
	                      <a href="#" class="animal effect-zoe magnific" data-mfp-src="<?php echo $images->imageName;?>">
	                    <img width="766"  src="<?php echo $images->imageName;?>" alt="no image" />
	                    </a>
	                    </div>
	                  </div>
	                  <?php } ?>   
                </div>
              </div>
          </div>
        </div>
		</div>
		
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>	
		<script> 
			
				 $("#assignment-dropzone").dropzone({  
      "maxFilesize": 20
    });
				Dropzone.autoDiscover = false;
			  //$(".dropzone").hide();
			  
			    $(".dropzone").slideToggle('slow');
			  
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
				      url: '<?php echo base_url()."/deletetrekgallery";?>',
				      data: {'id':id,'image_name':name},
				      success: function(result1) {
				      	console.log(result1);
				      	location.reload();
				      	 
				      }
				    });
				    
				  }
				})
			}
		
			$(".dropzone").click(function(){
			    $(".clearr").show();
			});
		    $(".clearr").click(function(){
			    $(".dropzone").animate({
			            height: 'toggle'
			    });
		        window.location.reload();			   
			});
		    $('#')
		</script>
		
<script type="text/javascript" src="<?php echo baseURL1;?>/js/dropzone.min.js"></script>
	</body>
</html>