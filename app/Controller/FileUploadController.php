<?php

class FileUploadController extends AppController {
	public function index() {

		if ($this->request->is('post')) {
	
			$handle = fopen($this->request->data['FileUpload']['file']['tmp_name'], "r");
			$line = 0;
			while ($data = fgetcsv($handle)){
				
				if ($line == 0) { //remove header
					$line++;
					continue;
				}
						
				$this->FileUpload->create();
				$this->FileUpload->save([
					'name' => $data[0],
					'email' => $data[1]
				]);
			}
			fclose($handle);
			return $this->redirect(array('action' => 'index'));
        }

		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}
}