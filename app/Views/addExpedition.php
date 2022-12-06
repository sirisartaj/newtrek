<html>
<head>
	<title>Expedition</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<style type="text/css">
   .form-control input
    {
      width: 1239px;      
    }        
</style>
    
	</head>
	<body>
		<form action="<?php echo base_url().'/storeexpedition'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data">
		<div class="form-group">
        <div class="mb-3">
          <label for="" class="form-label">Trip Title</label>
          <input type="text" class="form-control" name="Expedition_title" value="<?= set_value('Expedition_title');?>"placeholder="Title" />
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Trip Fee</label>
          <input type="text" class="form-control" name="Expedition_fee" value="<?= set_value('Expedition_fee');?>"/> 
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Trip Days</label>
          <input type="text" class="form-control" name="Expedition_days" value="<?= set_value('Expedition_days');?>"/>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Overview</label>
          <textarea name="Expedition_overview" id="trekOverview" class="summernote"><?php echo $result->Expedition_overview; ?></textarea>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Things to carry</label>
          <textarea name="things_carry" id="thingsCarry" class="summernote"><?php echo $result->things_carry; ?></textarea>
          
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Terms & Conditions</label>
          <textarea name="terms" id="terms" class="summernote"><?php echo $result->terms; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">How to reach</label>
          <textarea name="map_image" id="mapImage" class="summernote"><?php echo $result->map_image; ?></textarea>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Save">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>
		
		</form>
		
	<script> 
$(document).ready(function() {
  
  $('#trekOverview').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'trekOverview');
        }
    }
});
    $('#thingsCarry').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'thingsCarry');
        }
    }
});
    $('#terms').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'terms');
        }
    }
});
    $('#mapImage').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'mapImage');
        }
    }
});

  function sendFile(file, editor, welEditable,summernotid) {
  	//alert('hi');
  	console.log(file);
    data = new FormData();
    data.append("file", file);
    data.append("foldername",summernotid);
    $.ajax({
      data: data,
      type: "POST",
      url: "<?php echo base_url().'/fileupload';?>",
      cache: false,
      contentType: false,
      processData: false,
      success: function(url) {
      	console.log(url);
      	var image = $('<img>').attr('src',url);
            $('#'+summernotid).summernote("insertNode", image[0]);
      	 
      }
    });
  }
});
		</script>
		</body>
</html>