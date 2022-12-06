<html>
<head>
	<title>leisureing</title>
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
		<div class="container" style="margin:0px;">
		<form action="<?php echo base_url().'/storeleisure'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data">
			
    <div class="form-group">
        <div class="mb-3">
          <label for="" class="form-label">Trip Title</label>
          <input type="text" class="form-control" name="pkg_name" value="<?= set_value('pkg_name');?>"placeholder="Title" style="width: 1239px;"/> 
             

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Days</label>
          <input type="text" class="form-control" name="pkg_days" value="<?= set_value('pkg_days');?>"placeholder="Title" style="width: 1239px;"/> 
             

        </div>
        <div class="mb-3">
          <label for="" class="form-label">Overview</label>
          <textarea name="pkg_overview" id="pkg_overview" class="summernote"><?php echo $result->pkg_overview; ?></textarea>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Inclusion Exclusion</label>
          <textarea name="inclusion_exclusion" id="inclusion_exclusion" class="summernote"><?php echo $result->inclusion_exclusion; ?></textarea>
          
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Terms & Conditions</label>
          <textarea name="terms_conditions" id="terms" class="summernote"><?php echo $result->terms_conditions; ?></textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">How to reach</label>
          <textarea name="where_report" id="where_report" class="summernote"><?php echo $result->where_report; ?></textarea>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Save">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>
		
		</form>
		</div>
	<script> 

  
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

		</script>
		</body>
</html>