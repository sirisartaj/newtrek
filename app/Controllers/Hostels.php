<?php 
    namespace App\Controllers; 
    use CodeIgniter\Controller;
    use App\Models\Hostels_model;
     
    class Hostels extends Controller
    {
        public function index() {
            $model = new Hostels_model();
            $data['hostels'] = $model->getHostelsLists();   
            // var_dump($data);die(); 
            return view('hostels_view',$data);
        }

        public function hostelsFaq($hostel_id){
            $model = new Hostels_model();
            $data['hostelfaqs'] = $model->getHostelsFaqs($hostel_id); 
            $data['hostel_id'] = $hostel_id;
             if(empty($data['hostelfaqs']->faq)){
                $data['hostelfaqs']->faq = [];
            } 
            // var_dump($data);die();            
            return view('hostelsfaq_view',$data);
        }

        public function addHostelFaq($hostel_id){ 
            $model = new Hostels_model(); 
            $data['categories'] = $model->getCategories();
            $data['hostel_id'] = $hostel_id;  
            // var_dump($data);die;
            return view('addHostelFaq',$data);
        }

        public function saveFaq(){
            $model = new Hostels_model();
            $data = array(
                'catId' => $this->request->getPost('category_id'),
                'question' => $this->request->getPost('question'),
                'answer' => $this->request->getPost('answer'),
                'hostel_id' => $this->request->getPost('hostel_id')
            );       
            $model->saveFaq($data);
            return $this->response->redirect(base_url('/hostelsFaq/'.$data['hostel_id'])); 
        }

        public function editFaq($faq_id){
            // echo $faq_id;die();
            $model = new Hostels_model();
            $data['faq'] = $model->getEditFaq($faq_id)->faq[0]; 
            $data['categories'] = $model->getCategories();
            // var_dump($data);die();
            return view('editHostelFaq',$data);
        }

        public function updateFaq(){
            $model = new Hostels_model();
            $data = array(
                'catId' => $this->request->getPost('category_id'),
                'question' => $this->request->getPost('question'),
                'answer' => $this->request->getPost('answer'),
                'faq_id' => $this->request->getPost('faq_id'),
                'hostel_id' => $this->request->getPost('hostel_id')
            );   
            // var_dump($data);die();    
            $model->updateFaq($data);
            return $this->response->redirect(base_url('/hostelsFaq/'.$data['hostel_id'])); 
        }

        public function deleteHostelFaq($faq_id,$hostel_id){
            // echo $faq_id;echo "<br>".$hostel_id;die();
            $model = new Hostels_model();
            $data = array(
                'faq_id' => $faq_id,
                'status' => '9',
                'modified_by' => '1'
            );  
            $model->deleteHostelFaq($data);
           return $this->response->redirect(base_url('/hostelsFaq/'.$hostel_id)); 
        }
        public function deletehostelgallery(){
            
            $model = new Hostels_model();
            $id = $this->request->getVar('id');
            $image_name= $this->request->getVar('image_name');

            $data = array(
                'image_id' => $id,
                'image_name' => $image_name,
                'status' => '9',
                'modified_by' => '1',
                'modified_date' => date('Y-m-d H:i:s')
            );  
            $res = $model->deletegallery($data);
           echo json_encode($res);
           
        }

         public function hostelGallery($hostel_id){
            $data['hostel_id'] = $hostel_id;
            $model = new Hostels_model();
            $data['galleryImages'] = $model->getGalleryimages($hostel_id); 
            if(empty($data['galleryImages']->gallery_image)){
                $data['galleryImages']->gallery_image = [];
            }
            // var_dump($data);die();
            return view('hostelgallery_view',$data);
        }

        public function addGallerydetails($hostel_id){
            // var_dump($_FILES);die;

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
                    // var_dump($img);die();
                    $arr = explode('/', $img->getClientMimeType());
                    // var_dump($arr);die();
                    $img->move(IMGUPLOAD.'hostels/');
                    $data = [
                       'image_name' =>  $img->getName(),
                       'ext'  => $arr[1],
                       'hostel_id' => $hostel_id];
                    $model = new Hostels_model();
                    $result = $model->addgalleryDetails($data);
                }
            }
            if($result){
                $data['galleryImages'] = $model->getGalleryimages($hostel_id); 
                return $this->response->redirect(base_url('/hostelGallery/'.$hostel_id)); 
                // $this->session->sets("success_msg","images added successfully");
            }
        }

       
     
    }