<html>
<head>
	<title>expeditioning</title>
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
      width: 1239px !important;      
    }        
</style>
    
	</head>
	<body><div class="container" style="margin:0;">
		<form action="<?php echo base_url().'/editexpedition'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data" onSubmit="return validform();">
			<div class="form-group">
        <div class="mb-3">
          <label for="" class="form-label">Trip Title</label>
          <input type="text" class="form-control" name="expedition_title" value="<?php echo $result->expedition_title; ?>"placeholder="Title" style="width: 1239px !important;"/>
          <input type="hidden" class="form-control" name="expedition_id" value="<?php echo $result->expedition_id; ?>"placeholder="Title" style="width: 1239px !important;" id="trip_title"/>
          <span class="text-danger" id="trip_title-error">
              <?php  if ($validation->hasError('expedition_id')) {
                    echo $validation->getError('expedition_id');
                } ?>
          </span>
        </div>
        

        <div class="mb-3">
          <label for="" class="form-label">Overview</label>
          <textarea name="expedition_overview" id="expedition_overview" class="summernote"><?php echo $result->expedition_overview; ?></textarea>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Things to carry</label>
          <textarea name="things_carry" id="things_carry" class="summernote"><?php echo $result->things_carry; ?></textarea>
          
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Terms & Conditions</label>
          <textarea name="terms" id="terms" class="summernote"><?php echo $result->terms; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">How to reach</label>
          <textarea name="map_image" id="map_image" class="summernote"><?php echo $result->map_image; ?></textarea>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Update">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>
		
		</form>
		</div>
	<script> 

  
  $('#expedition_overview').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'expedition_overview');
        }
    }
});
    $('#things_carry').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'things_carry');
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
    $('#map_image').summernote({
    height: 200,
    width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'map_image');
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
      url: "<?php echo base_url().'/expeditionFileupload';?>",
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
function validform(){
      var error=0;
      
       if($('#tripOverview').summernote('isEmpty'))
        {
          $('#tripOverview-error').html('please enter trip Overview');
            error=1;
      }else{
        $('#tripOverview-error').html('');
      }
      if($('#trip_title').val()==''){
        $('#trip_title-error').html('Please Enter Trip Title');
        error=1;
      }else{
        $('#trip_title-error').html('');
      }

      if($('#mapImage').summernote('isEmpty')){
        $('#mapImage-error').html('please enter How to reach');
        error=1;
      }else{
        $('#mapImage-error').html('');
      }
      if($('#terms').summernote('isEmpty')){
        $('#terms-error').html('please enter terms and conditions');
        error=1;
      }else{
        $('#terms-error').html('');
      }
      if($('#thingsCarry').summernote('isEmpty')){
        $('#thingsCarry-error').html('please enter things Carry');
        error=1;
      }else{
        $('#thingsCarry-error').html('');
      }

      if(tripOverview==''){
        $('#tripOverview-error').html('please enter trip Overview');
        error=1;
      }else{
        $('#tripOverview-error').html('');
      }
      

      if(error){
        return false;
      }
    }
		</script>
		</body>
</html>