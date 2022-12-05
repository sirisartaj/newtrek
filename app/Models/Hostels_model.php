<?php 
	namespace App\Models;
	use CodeIgniter\Model; 

	use CodeIgniter\Controller;
	use App\Controllers\Home;

	class Hostels_model extends Model{		

		public function getHostelsLists(){
			$home = new Home();
	  		$url = base_url().'/riding/hostels/gethostels';
	  		return $home->CallAPI('GET',$url);
		}

		public function getHostelsFaqs($hostel_id){
			$home = new Home();
			$url = base_url().'/riding/hostels/getfaq/'.$hostel_id;
			return $home->CallAPI('GET',$url);
		}

		public function getCategories(){
			$home = new Home();
			$url = base_url().'/riding/faq/getfaqcategories';
			return $home->CallAPI('GET',$url);
		}

		public function saveFaq($data){
			$home = new Home();
			$url = base_url().'/riding/hostels/addhostelfaq';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}
		
		public function getEditFaq($faq_id){
			$home = new Home();
			$url = base_url().'/riding/hostels/getEditFaq/'.$faq_id;
			return $home->CallAPI('GET',$url);
		}

		public function updateFaq($data){
			$home = new Home();
			$url = base_url().'/riding/hostels/updatehostelfaq'; 
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}

		public function deleteHostelFaq($data){
			$home = new Home();
			$url = base_url().'/riding/hostels/updatehostelfaqstatus';
			return $home->CallAPI('POST',$url,$data);
		}

		public function getGalleryimages($hostel_id){
			$home = new Home();
			echo $url = base_url().'/riding/hostels/getgallery/'.$hostel_id;
			return $home->CallAPI('GET',$url);
		}
		
		public function addgalleryDetails($data){
			$home = new Home();
			$url = base_url().'/riding/hostels/addgallery';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}
		

		
		
	    


	}

?>