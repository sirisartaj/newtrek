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
<style type="text/css">
        
    .form-control input
		{
		  width: 1239px;
		  
		}
        
</style>
    
	</head>
	<body>
		<div class="container" style="margin-left: 0px;">
        <div class="panel ">
            <h3>New Trek </h3>
        </div>
		<form action="<?php echo base_url().'/storetrek'?>" method="post" name="adminform" id="adminform" enctype="multipart/form-data">
			


<div class="form-group">
        <div class="mb-3">
          <label for="" class="form-label">Trek Title</label>
          <input type="text" class="form-control" name="trek_title" value="<?= set_value('trek_title');?>"placeholder="Title" style="width: 1239px !important;"/> 
           
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Trek Fee</label>
          <input type="text" class="form-control" name="trek_fee" value="<?= set_value('trek_fee');?>"placeholder="trek Fee" style="width: 1239px !important;"/> 
           
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Trek Days</label>
          <input type="text" class="form-control" name="trek_days" value="<?= set_value('trek_days');?>"placeholder="trek days" style="width: 1239px !important;" /> 
           
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Overview</label>
          <textarea name="trek_overview" id="trekOverview" class="summernote">
          	<?= set_value('trekOverview');?>
          </textarea>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Things to carry</label>
          <textarea name="things_carry" id="thingsCarry" class="summernote">
          	<?= set_value('thingsCarry');?>
          </textarea>
          
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Terms & Conditions</label>
          <textarea name="terms" id="terms" class="summernote">
<?= set_value('terms');?>
          	</textarea>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">How to reach</label>
          <textarea name="map_image" id="mapImage" class="summernote">
          	<?= set_value('mapImage');?>
          </textarea>
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Save">
            <input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
        </div>
    </div>




		<!-- <table>
			<tr>
				<td>Trek</td>
				<td>:</td>
				<td>
					<input type="text" name="trek_title" value="<?= set_value('trek_title');?>"/> 
					
				</td>
			</tr>
			<tr>
				<td>Trek Fee</td>
				<td>:</td>
				<td>
					<input type="text" name="trek_fee" value="<?= set_value('trek_fee');?>"/> 
					
				</td>
			</tr>
			<tr>
				<td>Trek Days</td>
				<td>:</td>
				<td>
					<input type="text" name="trek_days" value="<?= set_value('trek_fee');?>"/> 
					
				</td>
			</tr>

			<tr>
				<td>Overview</td>
				<td>:</td>
				<td><textarea name="trek_overview" id="trekOverview" class="summernote"></textarea></td>
			</tr>

			<tr>
				<td>Things to carry</td>
				<td>:</td>
				<td><textarea name="things_carry" id="thingsCarry" class="summernote"></textarea></td>
			</tr>
			<tr>
				<td>Terms&Conditions</td>
				<td>:</td>
				<td><textarea name="terms" id="terms" class="summernote"></textarea></td>
			</tr>
			<tr>
				<td>How to reach</td>
				<td>:</td>
				<td><textarea name="map_image" id="mapImage" class="summernote"></textarea></td>
			</tr>
			<tr>
				<td colspan="3" align="center">
					<input type="submit" name="submit" value="Save">
					<input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);">
				</td>
			</tr>
		</table> -->
		</form>
		</div>
	<script> 

  
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

		</script>
		</body>
</html>