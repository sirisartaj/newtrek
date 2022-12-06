<html>
<head>
	<title>Treking</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    
	</head>
	<body>
		<form action="<?php echo base_url().'/editLeisure'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data" onSubmit="validcreateform();">
			<div class="form-group">
        <div class="mb-3">
          <label for="" class="form-label">Trip Title</label>
          <input type="text" class="form-control inputwidth" name="pkg_name" value="<?php echo $result->pkgName; ?>"placeholder="Title" style="width: 1239px;"/> 
          <input type="hidden" class="form-control" name="leisure_id" value="<?php echo $leisure_id; ?>"placeholder="Title" style="width: 1239px;"/> 
             
          <span class="text-danger" id="pkg_name-error">
              <?php  if ($validation->hasError('pkg_name')) {
                    echo $validation->getError('pkg_name');
                } ?>
          </span>
        </div>
        
        <div class="mb-3">
          <label for="" class="form-label">Overview</label>
          <textarea name="pkg_overview" id="pkg_overview" class="summernote"><?php echo $result->pkgOverview; ?></textarea>
          <span class="text-danger" id="pkg_overview-error">
            <?php  if ($validation->hasError('pkg_overview')) {
                    echo "The Overview feild is required";
                } ?></span>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Inclusion Exclusion</label>
          <textarea name="inclusion_exclusion" id="inclusion_exclusion" class="summernote"><?php echo $result->inclusionExclusion; ?></textarea>
          
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Terms & Conditions</label>
          <textarea name="terms_conditions" id="terms" class="summernote"><?php echo $result->termsConditions; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">How to reach</label>
          <textarea name="where_report" id="where_report" class="summernote"><?php echo $result->whereReport; ?></textarea>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Update">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>

		
		</form>
		
	<script> 
//$(document).ready(function() {
  
  $('#pkg_overview').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'pkg_overview');
        }
    }
});
    $('#inclusion_exclusion').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'inclusion_exclusion');
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
    $('#where_report').summernote({
    height: 200,width: 1239,
    callbacks: {
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable,'where_report');
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
      url: "<?php echo base_url().'/leisureFileupload';?>",
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

  function validcreateform(){
      var error=0;
      var thingscarry = $('#thingsCarry').val();
       thingscarry = $(thingscarry).text();

       var mapImage = $('#mapImage').val();
       mapImage = $(mapImage).text();

       var terms = $('#terms').val();
       terms = $(terms).text();

       var trekOverview = $('#trekOverview').val();
       trekOverview = $(trekOverview).text();

      if($('#pkg_name').val()==''){
        $('#pkg_name-error').html('Please Enter Package Name');
        error=1;
      }else{
        $('#trek_title-error').html('');
      }

      if(mapImage==''){
        $('#mapImage-error').html('please enter How to reach');
        error=1;
      }else{
        $('#mapImage-error').html('');
      }
      if(terms==''){
        $('#terms-error').html('please enter terms and conditions');
        error=1;
      }else{
        $('#terms-error').html('');
      }
      if(thingscarry==''){
        $('#thingsCarry-error').html('please enter things Carry');
        error=1;
      }else{
        $('#thingsCarry-error').html('');
      }

      if(trekOverview==''){
        $('#trekOverview-error').html('please enter trek Overview');
        error=1;
      }else{
        $('#trekOverview-error').html('');
      }
      

      if(error){
        return false;
      }
    }
		</script>
		</body>
</html>