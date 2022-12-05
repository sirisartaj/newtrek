<?php 
	namespace App\Models;
	use CodeIgniter\Model; 

	use CodeIgniter\Controller;
	use App\Controllers\Home; 

	class Expedition_model extends Model{		

		public function getExpeditionLists(){
			$home = new Home();
	  		$url = base_url().'/riding/expeditions/getexpeditions';
	  		return $home->CallAPI('GET',$url);
		}

		public function getExpeditionFaqs($expedition_id){
			$home = new Home();
			$url = base_url().'/riding/expeditions/getfaq/'.$expedition_id;
			return $home->CallAPI('GET',$url);
		}

		public function getCategories(){
			$home = new Home();
			$url = base_url().'/riding/faq/getfaqcategories';
			return $home->CallAPI('GET',$url);
		}

		public function saveFaq($data){
			$home = new Home();
			$url = base_url().'/riding/expeditions/addexpeditionfaq';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}
		
		public function getEditFaq($faq_id){
			$home = new Home();
			$url = base_url().'/riding/expeditions/getEditFaq/'.$faq_id;
			return $home->CallAPI('GET',$url);
		}

		public function updateFaq($data){
			$home = new Home();
			$url = base_url().'/riding/expeditions/updateexpeditionfaq'; 
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}

		public function deleteExpeditionFaq($data){
			$home = new Home();
			$url = base_url().'/riding/expeditions/updateexpeditionfaqstatus';
			return $home->CallAPI('POST',$url,$data);
		}

		public function getGalleryimages($expedition_id){
			$home = new Home();
			$url = base_url().'/riding/expeditions/expeditiongallery/'.$expedition_id;
			return $home->CallAPI('GET',$url);
		}
		
		public function addgalleryDetails($data){
			$home = new Home();
			$url = base_url().'/riding/expeditions/addexpeditiongallery';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}

		/* sartaj code*/

	    public function getExpedition($expedition_id =""){	       
	        $home = new Home();
	        $url = base_url().'/riding/expeditions/getexpedition/'.$expedition_id;
	       return $home->CallAPI('GET',$url);	      
	    }

	    public function get_itinerary_expedition($expedition_id =""){	       
	        $home = new Home();
	        $data = array();
	        $url = base_url().'/riding/expeditions/get_itinerary_expedition/'.$expedition_id;
	       return $home->CallAPI('GET',$url);	      
	    }

	    public function editExpeditiondata($data){           
	        $home = new Home();   	          
	       $url = base_url().'/riding/expeditions/updateexpedition';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function addexpedition($data){           
	        $home = new Home();   
	       $url = base_url().'/riding/expeditions/addexpedition';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function editExpeditioniterinarydata($data){           
	        $home = new Home();   
	       $url = base_url().'/riding/expeditions/editexpeditioniterinarydata';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function addExpeditioniterinarydata($data){           
	       $home = new Home();   
	       $url = base_url().'/riding/expeditions/addexpeditioniterinary';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function deleteitineraryexpedition($data){           
	       $home = new Home();   
	       $url = base_url().'/riding/expeditions/deleteiterinary';//exit;
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function editExpeditionstatus($data){           
	        $home = new Home();   
	       $url = base_url().'/riding/expeditions/updateexpeditionsstatus';//exit;
	       return $home->CallAPI('POST',$url,$data);          
	    }

		

		
		
	    


	}

?>