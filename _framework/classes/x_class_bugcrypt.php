<?php
	/*	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  Bugcrypt Control Class */	
	class x_class_bugcrypt {
		// Local Path
		private $zip_path = false;
		// Local File
		private $zip_file = false;
		// Parameters
		private $crypt = false; //$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
		
		// Constructor
		function __construct($zipfile_path = false, $folder_path = false, $cryptokey = false) {
			$this->zip_path = $folder_path;
			$this->crypt = $cryptokey;
			$this->zip_file = $zipfile_path;
		}
		
		// Zip Path to File
		public function zip() {
			if(!$this->zip_path OR !$this->zip_file) { return false; }
			if($this->crypt) {
				$source = $this->zip_path;
				if (!file_exists($source)) {return false;}
				// Create Archive
				$zip = new ZipArchive();
				if (!$zip->open($this->zip_file, ZIPARCHIVE::CREATE)) {return false;}
				$source = str_replace('\\', '/', realpath($source));
				if (is_dir($source) === true){
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file){
						$file = str_replace('\\', '/', $file);
						// Ignore "." and ".." folders
						if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) ) continue;
						$file = realpath($file);
						if (is_dir($file) === true) { $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));}
						else if (is_file($file) === true) { $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file)); }
					}
				} else if (is_file($source) === true) { $zip->addFromString(basename($source), file_get_contents($source));}
				$zip->close();
				$code = file_get_contents($this->zip_file);
				$encrypted_code = my_encrypt($code, $this->crypt);
				file_put_contents($this->zip_file.".bugcrypt", $encrypted_code);
				unlink($this->zip_file);
				return true;
			} else {
				$source = $this->zip_path;
				if (!file_exists($source)) {return false;}
				// Create Archive
				$zip = new ZipArchive();
				if (!$zip->open($this->zip_file, ZIPARCHIVE::CREATE)) {return false;}
				$source = str_replace('\\', '/', realpath($source));
				if (is_dir($source) === true){
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file){
						$file = str_replace('\\', '/', $file);
						// Ignore "." and ".." folders
						if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) ) continue;
						$file = realpath($file);
						if (is_dir($file) === true) { $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));}
						else if (is_file($file) === true) { $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file)); }
					}
				} else if (is_file($source) === true) { $zip->addFromString(basename($source), file_get_contents($source));}
				$zip->close();
				return true;			
			}
		}
		// Unzip File to Path
		public function unzip() {
			if(!$this->zip_path OR !$this->zip_file) { return false; }
			if($this->crypt) {
				$encrypted_code = file_get_contents($this->zip_file);
				$decrypted_code = decrypt($encrypted_code, $this->crypt);
				file_put_contents($this->zip_file.".tmp", $decrypted_code);
				$zip = new ZipArchive;
				if ($zip->open($this->zip_file.".tmp") === TRUE) {
					$zip->extractTo($this->zip_path);
					$zip->close();
					unlink($this->zip_file.".tmp");
					return true;
				} else { return false; }
			} else {
				$zip = new ZipArchive;
				if ($zip->open($this->zip_file) === TRUE) {
					$zip->extractTo($this->zip_path);
					$zip->close();
					return true;
				} else { return false; }			
			}
		}	
		// Encrypt Data and Return
		public function encrypt($data, $key) {
			$encryption_key = base64_decode($key);
			$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
			$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
			return base64_encode($encrypted . '::' . $iv);
		}		
		// Decrypt Data and Return
		public function decrypt($data, $key) {
			$encryption_key = base64_decode($key);
			list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
			return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
		}		
	}
?>