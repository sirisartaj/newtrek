<?php 
  namespace App\Controllers; 
  use CodeIgniter\Controller;
  use App\Models\Biketrip_model;
  class Biketrip extends Controller{
  public function index() {
    $model = new Biketrip_model();
    $data['biketrips'] = $model->getBikeTripLists();   
    return view('biketrips_view',$data);
  }
  public function biketripFaq($tripId){
    $model = new Biketrip_model();
    $data['tripfaqs'] = $model->getBiketripFaqs($tripId); 
    $data['tripId'] = $tripId;
    if(empty($data['tripfaqs']->faq)){
        $data['tripfaqs']->faq = [];
    }
    return view('biketripfaq_view',$data);
  }
  public function addBikeFaq($tripId){ 
    $model = new Biketrip_model(); 
    $data['categories'] = $model->getCategories();
    $data['tripId'] = $tripId;  
    return view('addBikeFaqs',$data);
  }
  public function saveFaq(){
    $model = new Biketrip_model();
    $data = array(
        'catId' => $this->request->getPost('category_id'),
        'question' => $this->request->getPost('question'),
        'answer' => $this->request->getPost('answer'),
        'tripId' => $this->request->getPost('tripId')
    );       
    $model->saveFaq($data);
    return $this->response->redirect(base_url('/biketripFaq/'.$data['tripId'])); 
  }
  public function editFaq($faq_id){
    $model = new Biketrip_model();
    $data['faq'] = $model->getEditFaq($faq_id)->faq[0]; 
    $data['categories'] = $model->getCategories();
    return view('editBikeFaq',$data);
  }
  public function updateFaq(){
    $model = new Biketrip_model();
    $data = array(
              'catId' => $this->request->getPost('category_id'),
              'question' => $this->request->getPost('question'),
              'answer' => $this->request->getPost('answer'),
              'faq_id' => $this->request->getPost('faq_id'),
              'tripId' => $this->request->getPost('tripId')
            );   
    $model->updateFaq($data);
    return $this->response->redirect(base_url('/biketripFaq/'.$data['tripId'])); 
  }
  public function deleteBikeFaq($faq_id,$tripId){
    $model = new Biketrip_model();
    $data = array(
        'faq_id' => $faq_id,
        'status' => '9',
        'modified_by' => '1'
    );  
    $model->deleteBikeFaq($data);
    return $this->response->redirect(base_url('/biketripFaq/'.$tripId)); 
  }
  public function tripGallery($tripId){
    $data['tripId'] = $tripId;
    $model = new Biketrip_model();
    $data['galleryImages'] = $model->getGalleryimages($tripId); 
    if(empty($data['galleryImages']->gallery_image)){
        $data['galleryImages']->gallery_image = [];
    } 
    return view('tripgallery_view',$data);
  }
  public function addgallerydetails($tripId){
    helper(['form', 'url']);
    if($_FILES['file']['name']!=''){
      $input = $this->validate([
          'file' => [
              'uploaded[file]',
              'mime_in[file,image/jpg,image/jpeg,image/png]',
              'max_size[file,2048]',
          ]
      ]);
      if (!$input) {
        print_r('Choose a valid file');
      } else {
          $img = $this->request->getFile('file');
          $arr = explode('/', $img->getClientMimeType());
          $img->move(IMGUPLOAD.'biketripsgallery/');
          $data = [
             'image_name' =>  $img->getName(),
             'ext'  => $arr[1],
             'tripId' => $tripId];
          $model = new Biketrip_model();
          $result = $model->addgalleryDetails($data);
      }
    }
    if($result){
      $data['galleryImages'] = $model->getGalleryimages($tripId); 
      return $this->response->redirect(base_url('/biketripGallery/'.$tripId)); 
    }
  }

        /* sartaj code starts*/
        public function biketripItinerary($trip_id=''){
            $BikeModel = new Biketrip_model();
            $data['trip_id'] =$trip_id;
            helper(['form']);
            $rules = [ ];
            $trip = (array) $BikeModel->get_itinerary_trip($trip_id);
            if($trip['status'] =200){
                 $data['result']  = json_decode(json_encode($trip['biketrip']));
            }
         
            $data['Headding']="Itinerary trip";
            if($this->validate($rules)){

            }else{
                $data['validation'] = $this->validator;
            }
            echo view('biketrip_itinerary',$data);
        }

        public function biketripiterinarystore(){
          $entered = $this->request->getVar();
            
            $c = count($this->request->getVar('iterinary_id'));
            helper(['form']);
           
                $BikeModel = new Biketrip_model();
                for($i=0;$i<$c;$i++){
                                  if($entered['iterinary_id'][$i]){

                        $udata = [
                            'iterinary_id'=>$entered['iterinary_id'][$i],
                            'iterinary_title'=>$this->request->getVar('iterinary_title')[$i],
                            'iterinary_details' =>$this->request->getVar('iterinary_details')[$i],
                            'biketrips_id'=>$this->request->getVar('biketrips_id'),
                            'modified_date'=>date('Y-m-d H:i:s'),
                            'modified_by'=>"1"
                        ];
                        $a[] = $BikeModel->edittripiterinarydata($udata);
                    }
                    else{                
                        $idata = [                    
                            'biketrips_id'=>$this->request->getVar('biketrips_id'),
                            'created_date'=>date('Y-m-d H:i:s'),
                            'created_by'=>"1",
                            'status'=>"0",
                            'iterinary_title'=>$this->request->getVar('iterinary_title')[$i],
                            'iterinary_details' =>$this->request->getVar('iterinary_details')[$i]
                        ];
                        $a['insert'] = $BikeModel->edittripiterinarydata($idata);  
                    }           
                }
            
                if($a){
                    
                    $data['biketrips'] = $BikeModel->getBikeTripLists(); 
                    return view('biketrips_view',$data);
                    
            
            }
            else{
                $data['validation'] = $this->validator;
                echo view('addtrip', $data);
            }
        }    

        public function addBikeTrip(){
            helper(['form']);
            $rules = [ ];            
            if($this->validate($rules)){

            }else{
                $data['validation'] = $this->validator;            
                echo view('addtrip',$data);
            }
        }

        public function storeBiketrip() {
      
            helper(['form']);
           $rules = [
                'trip_fee'      => 'required',
                'trip_days'      => 'required',
                'trip_title'      => 'required|is_unique[sg_tripingdetails.trip_title]'
            ];
            // echo "hi";
            if($this->validate($rules)){  
                echo "validate";die;
                $BikeModel = new Biketrip_model();
                $trip_overview = str_replace('"','\'', $this->request->getVar('trip_overview'));
                $things_carry = str_replace('"','\'', $this->request->getVar('things_carry'));
                $terms = str_replace('"','\'', $this->request->getVar('terms'));
                $mapimage = str_replace('"','\'', $this->request->getVar('map_image'));
                $data = [
                    'trip_title'     => $this->request->getVar('trip_title'),
                    'trip_fee'    => $this->request->getVar('trip_fee'),                
                    'trip_days' =>$this->request->getVar('trip_days'),
                    'trip_overview'=> htmlspecialchars($trip_overview, ENT_QUOTES),
                    'things_carry' => htmlspecialchars($things_carry, ENT_QUOTES),
                    'terms' => htmlspecialchars($terms, ENT_QUOTES),
                    'map_image' => htmlspecialchars($mapimage, ENT_QUOTES),
                    'created_date' =>date('Y-m-d H:i:s'),
                    'created_by' =>1,
                    'status' =>0
                ];

                $a = $BikeModel->addtrip($data);
                //print_r($a);exit;
                if($a->status ==200){
                    $_SESSION['message'] = $a->message;
                    return redirect()->to('addtrip');
                }else{

                    $data['validation'] = $this->validator;
                    echo view('addtrip', $data);
                }
                
            }else{
                echo "no";die;
                $data['validation'] = $this->validator;
                echo view('addtrip', $data);
            }
        }

        public function editBikeTrip(){
            $BikeModel = new Biketrip_model();
            helper(['form']);
            $rules = [
                'trip_id'      => 'required'
            ];
          
            if($this->validate($rules)){ 
            
                $trip_overview = str_replace('"','\'', $this->request->getVar('trip_overview'));
                $things_carry = str_replace('"','\'', $this->request->getVar('things_carry'));
                $terms = str_replace('"','\'', $this->request->getVar('terms'));
                $mapimage = str_replace('"','\'', $this->request->getVar('map_image'));
                $data = [
                    'biketrips_id'    => $this->request->getVar('trip_id'),
                    'trip_title'    => $this->request->getVar('trip_title'),
                    'trip_overview'=> htmlspecialchars($trip_overview, ENT_QUOTES),
                    'things_carry' => htmlspecialchars($things_carry, ENT_QUOTES),
                    'terms_conditions' => htmlspecialchars($terms, ENT_QUOTES),
                    'how_to_reach' => htmlspecialchars($mapimage, ENT_QUOTES),
                    'modified_date' =>date('Y-m-d H:i:s'),
                    'modified_by' =>1,

                ];
               
               $a = $BikeModel->edittripdata($data);
               
                return redirect()->to('/biketripslist');
            }else{
                $rules = [];
                $trip = (array) $BikeModel->getTrip($trip_id);           
                if($trip['status'] =200){
                     $data['result']  = $trip['trip_details']->trips;
                }
                if($this->validate($rules)){}else{
                    $data['Headding']="Edit trip";
                $data['validation'] = $this->validator;
                echo view('bike/tripedit', $data);
                }
            }
    
        }

        function getBikeTrip($trip_id=''){
            $BikeModel = new Biketrip_model();
            helper(['form']);
            $rules = [ ];
            $trip = (array) $BikeModel->getTrip($trip_id);
            if($trip['status'] =200){
                $data['result']  = $trip['biketrip']->trips;
            }            
            $data['Headding']="Edit trip";
            if($this->validate($rules)){}else{
                $data['validation'] = $this->validator;
            }
            echo view('editbiketrip',$data);
        }

        function getBikeTripItinerary($trip_id=''){
            $BikeModel = new Biketrip_model();
            $data['trip_id'] =$trip_id;
            helper(['form']);
            $rules = [ ];
            $trip = (array) $BikeModel->get_itinerary_trip($trip_id);
            if($trip['status'] =200){
                 $data['result']  = json_decode(json_encode($trip['biketrip']));
            }
            $data['Headding']="Itinerary trip";
            if($this->validate($rules)){

            }else{
                $data['validation'] = $this->validator;
            }
            echo view('bike/trip_itinerary',$data);
        }

        function fileupload(){
          
            $file = $this->request->getFile('file');
            $foldername = $this->request->getvar('foldername');
            if ($file) {
              if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $filename = $name.'.'.$ext;
                  $file->move(baseimgURL.$foldername.'/', $filename);
              
                echo SITEURL.$foldername.'/'.$filename;
              }
            }
            
        }
            
           
        

       
     
    }