<html>
<head>
	<title>triping</title>
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
    .text-danger{
        color: red;
    }     
</style>
	</head>
	<body>
		<form action="<?php echo base_url().'/editBiketrip'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data" onSubmit="return validform();">
	 <div class="form-group">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Trip Title</label>
          <input type="text" class="form-control" name="trip_title" value="<?php echo $result->tripTitle; ?>"placeholder="Title" id="trip_title"/> 
            <input type="hidden" name="trip_id" value="<?php echo $result->tripId; ?>"/> 
            <span class="text-danger" id="trip_title-error">
              <?php  if ($validation->hasError('trip_title')) {
                    echo $validation->getError('trip_title');
                } ?>
          </span>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Overview</label>
          <textarea name="trip_overview" id="tripOverview" class="summernote"><?php echo $result->tripOverview; ?></textarea>
           <span class="text-danger" id="tripOverview-error">
            <?php  if ($validation->hasError('trip_overview')) {
                    echo "The Overview feild is required";
                } ?></span>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Things to carry</label>
          <textarea name="things_carry" id="thingsCarry" class="summernote"><?php echo $result->thingsCarry; ?></textarea>
          <span class="text-danger" id="thingsCarry-error"><?php  if ($validation->hasError('things_carry')) {
            echo "The Things Carry feild is required";
                    //echo $validation->getError('things_carry');
                } ?></span>
          
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Terms & Conditions</label>
          <textarea name="terms" id="terms" class="summernote"><?php echo $result->termsConditions; ?></textarea>
          <span class="text-danger" id="terms-error"><?php  if ($validation->hasError('terms')) {
                    echo "The Terms & Conditions feild is required";
                } ?></span>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">How to reach</label>
          <textarea name="map_image" id="mapImage" class="summernote"><?php echo $result->howToReach; ?></textarea>
          <span class="text-danger" id="mapImage-error"><?php  if ($validation->hasError('map_image')) {
                    echo "The How to reach feild is required";
                } ?></span>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Update">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>
		
		</form>
		
	<script> 
  
  $('#tripOverview').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'tripOverview');
        }
    }
});
    $('#thingsCarry').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'thingsCarry');
        }
    }
});
    $('#terms').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'terms');
        }
    }
});
    $('#mapImage').summernote({
    height: 200,width: 1239,
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
      url: "<?php echo base_url().'/bikefileupload';?>",
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