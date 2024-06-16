<?php

class Utils
	{
		public $_file;
		public $_id;
		public $_host;
		public $_result;


		public function log_error($e){
			$_error_file = "/tmp/".time().".log";
			error_log($e, 3, $_error_file);
		}

		public function __wakeup(){
			try
				{
					// check if format file is exists?
	    			include $this->_file;
				}
			catch (Exception $e)
				{
				    throw $e;
				}
		}

		public function extract_api_to_object(){
			try
				{
					$YOUTUBE_API_KEY = "AIzaSyDNr58B64YFXS18FdYfdRADHGI1HFge5BI";
					$host  			 = strtolower($this->_host);
					switch ($host) {
						case "youtube":
							$link 		= "https://www.googleapis.com/youtube/v3/videos?id=".$this->_id."&key=".$YOUTUBE_API_KEY."&part=snippet";
							$json 		= file_get_contents($link);
							$content 	= json_decode($json,true);
							break;
						
						case "vimeo":
							$link 		= "https://vimeo.com/api/v2/video/".$this->_id.".php";
							$serial_obj = file_get_contents($link);
							$content 	= unserialize($serial_obj);
							break;

						case "local":
							//$link 		= $this->_id;
							$link       = "http://localhost:1337/".$this->_id;
							$serial_obj = file_get_contents($link);
							$content 	= unserialize($serial_obj);
							break;

						default:
							$error = "Invalid host ".$host;
							$this->log_error($error);
							die($error);
							break;
					}
					
				}
			catch (Exception $e)
				{
					// Delete the output buffer
	        		throw($e);
				}
			return $content;
		}

		public function extract_video_information(){
			try
				{
					$host  			 = strtolower($this->_host);
					switch($host) {
						case "youtube":
							$content = $this->extract_api_to_object();
							@$this->_result ['title'] = $content['items'][0]['snippet']['title'];
							@$this->_result ['description'] = $content['items'][0]['snippet']['description'];
							@$this->_result ['thumbnails'] = $content['items'][0]['snippet']['thumbnails']['default']['url'];
							break;
						case "vimeo":
							$content = $this->extract_api_to_object();
							@$this->_result ['title'] = $content[0]['title'];
							@$this->_result ['description'] = $content[0]['description'];
							@$this->_result ['thumbnails'] = $content[0]['thumbnail_small'];
							break;
						case "local":
							$content = $this->extract_api_to_object();
							@$this->_result ['title'] = $content[0]['title'];
							@$this->_result ['description'] = $content[0]['description'];
							@$this->_result ['thumbnails'] = $content[0]['thumbnail_small'];
							break;
						default:
							$error = "Invalid host ".$host;
							$this->log_error($error);
							die($error);
							break;
					}
				}
			catch (Exception $e)
				{
					// Delete the output buffer
				    throw($e);
				}
		}
		

		public function __toString(){
			try
				{
					// get the format string
	    			include $this->_file;
	    			return sprintf($format_string, $this->_result ['title'], $this->_result ['description'], $this->_result ['thumbnails']);
				}
			catch (Exception $e)
				{
				    throw $e;
				}
		}

	}

?>
