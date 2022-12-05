<?php 
	namespace App\Models;
	use CodeIgniter\Model; 

	use CodeIgniter\Controller;
	use App\Controllers\Home;

	class Biketrip_model extends Model{

		public function getBikeTripLists(){
			$home = new Home();
	  		$url = base_url().'/riding/biketrips/getbiketrips';
	  		// echo $url;die();
	  		return $home->CallAPI('GET',$url);
		}

		public function getBiketripFaqs($tripId){
			$home = new Home();
			$url = base_url().'/riding/biketrips/getfaq/'.$tripId;
			// echo $url;die(); 
			return $home->CallAPI('GET',$url);
		}

		public function getCategories(){
			$home = new Home();
			$url = base_url().'/riding/faq/getfaqcategories';
			// echo $url;die();
			return $home->CallAPI('GET',$url);
		}

		public function saveFaq($data){
			$home = new Home();
			$url = base_url().'/riding/biketrips/addtripfaq';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			// var_dump(json_encode($data));die();
			return $home->CallAPI('POST',$url,$data);
		}
		
		public function getEditFaq($faq_id){
			$home = new Home();
			$url = base_url().'/riding/biketrips/getEditFaq/'.$faq_id;
			// echo $url;die();
			return $home->CallAPI('GET',$url);
		}

		public function updateFaq($data){
			$home = new Home();
			$url = base_url().'/riding/biketrips/updatetripfaq'; 
			$data['status'] = 0;
			$data['createdBy'] = '1';
			// var_dump(json_encode($data));die;
			return $home->CallAPI('POST',$url,$data);
		}

		public function deleteBikeFaq($data){
			// var_dump(json_encode($data));die();
			$home = new Home();
			$url = base_url().'/riding/biketrips/updatetripfaqstatus';
			// echo $url;die;
			return $home->CallAPI('POST',$url,$data);
		}
		
		public function getGalleryimages($trip_id){
			$home = new Home();
			$url = base_url().'/riding/biketrips/getgallery/'.$trip_id;
			// echo $url;die();
			return $home->CallAPI('GET',$url);
		}
		
		public function addgalleryDetails($data){
			$home = new Home();
			$url = base_url().'/riding/biketrips/addgallery';
			$data['status'] = 0;
			$data['createdBy'] = '1';
			return $home->CallAPI('POST',$url,$data);
		}

		/* sartaj code*/
		public function get_itinerary_trip($trip_id =""){       
	        $home = new Home();
	        $data = array();
	        $url = base_url().'/riding/biketrips/gettripitinerary/'.$trip_id;
	        return $home->CallAPI('GET',$url,$data);	      
	    }

	     public function addtripiterinarydata($data){           
	        $home = new home();   
	        $url = base_url().'/riding//biketrips/addbiketripiterinary';//exit;
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function edittripiterinarydata($data){           
	        $home = new Home();   
	       $url = base_url().'/riding/biketrips/editbiketripiterinary';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	     public function addtrip($data){           
	        $home = new Home();
	       $url = base_url().'/riding/biketrips/addbiketrip';
	       return $home->CallAPI('POST',$url,$data);          
	    }

	    public function getTrip($trip_id =""){       
	        $home = new Home();
	        $url = base_url().'/riding/biketrips/getbiketrip/'.$trip_id;
	       return $home->CallAPI('GET',$url);	      
	    }

	    public function edittripdata($data){           
	        $home = new Home();   
	       $url = base_url().'/riding/biketrips/updatebiketrip';
	       return $home->CallAPI('POST',$url,$data);          
	    }

		
		
	    


	}

?>