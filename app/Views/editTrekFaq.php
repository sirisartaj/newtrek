<!DOCTYPE html>
<html>
	<head> 
		<title>Edit FAQ</title>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


	    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

		<style>
			/*@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
			.form_bg{
				border: 1px solid grey;
			    border-radius: 25px;
			    padding: 10px;
			    margin-top: 25px;
			    background-color: #f0f0f0;
			}*/
		</style>
<style type="text/css">
	.inputwidth{
		width: 1239px;
	}
</style>
	</head>
	<body>
		<div class="container" style="margin:0">
						
				<form class=" form_bg" action="<?php echo base_url('/updateFaq')?>" method="POST" name="editFaqForm" id="editFaqForm">
					<div class="form-group">
					<div class="mb-3">
			           <label for="" class="form-label">Category</label>                    
						<select class="form-control inputwidth" id="faq_category" name="category_id" required>
						    	<?php foreach($categories -> faq_categories as $category) :?>
						    	<option <?php if($category->faqCatId == $faq->cat_id) echo "selected";?> value="<?php echo $category->faqCatId;?>" ><?php echo $category->categoryTitle;?></option>
							 <?php endforeach;?>
						</select> 
			        </div>		            
		            <div class="mb-3">
		                <label for="question" class="form-label">Question</label>
		                <input type="text" class="form-control inputwidth" id="question" name="question" value="<?php echo $faq->question;?>">
		            </div>
		            <div class="mb-3">
		                <label for="faq_answer" class="form-label">Answer:</label>
						<!-- <textarea   id="faq_answer" name="answer" ></textarea> -->
						<textarea id="faq_answer" name="answer" value="<?php echo $faq->answer;?>"></textarea>
		            </div>
		            <input type="hidden" name="faq_id" value="<?php echo $faq->faq_id;?>">
		            <input type="hidden" name="trek_id" value="<?php echo $faq->trek_id;?>">
		            <div class="row" style="Clear:both;margin: 10px;"></div>
		            <div class="mb-3">
						<input type="submit"  name="submit" value="Save" />
						<input type="button" name="cancel" value="Cancel" onclick="javascript:history.go(-1);" />
					</div>		
					</div>		
				</form>
			
		</div>
		<script>		
			$('textarea').summernote({
			    height: 200,width: 1239,
			    callbacks: {
			        onImageUpload: function(files, editor, welEditable) {
			            sendFile(files[0], editor, welEditable,this.id);
			        }
			    }
			});

			function sendFile(file, editor, welEditable,summernotid) {
			  	
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