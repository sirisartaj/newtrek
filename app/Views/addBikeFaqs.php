<!DOCTYPE html>
<html>
	<head> 
		<title>Add FAQ</title>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
			.inputwidth{
				width: 1239px;
			}
		</style>

	</head>
	<body>
		<div class="container" style="margin:0">
						
				<form class="" action="<?php echo base_url('/saveBikeFaq')?>" method="POST" name="addFaqForm" id="addFaqForm">
		            <div class="form-group">
		            <div class="mb-3">
		                <label for="faq_category" class="form-label">Category</label>
		                <select class="form-control inputwidth" id="faq_category" name="category_id" required>
		                	<?php foreach($categories -> faq_categories as $category){ ?>
							<option  value="<?php echo $category->faqCatId;?>"><?php echo $category->categoryTitle;?></option>
						<?php } ?>
		                </select> 
		            </div>
		            <div class="mb-3">
		                <label for="question" class="form-label">Question</label>
		                <input type="text" class="form-control inputwidth" id="question" name="question" required>
		            </div>
		            <div class="mb-3">
		                <label for="faq_answer" class="form-label">Answer</label>
						<!-- <textarea   id="faq_answer" name="answer" ></textarea> -->
						<textarea id="faq_answer" name="answer" required></textarea>
		            </div>
		            <input type="hidden" name="tripId" value="<?php echo $tripId;?>">
		            <div class="mb-3">
						<input type="submit" class="" name="submit" value="Save" />
						<input type="button" class="" name="cancel" onclick="javascript:history.go(-1);" value="Cancel" />
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