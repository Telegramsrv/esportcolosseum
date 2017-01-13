<?php
function deleteMedia($mediaPath) {
	
	/*
	 * gc_collect_cycles();
	 *
	 * $bool = true;
	 * $excludeMedia = array('default-profile.png');
	 *
	 * foreach($excludeMedia as $media){
	 * $pos = strpos($mediaPath, $media);
	 * if ($pos !== false) {
	 * $bool = false;
	 * }
	 * }
	 *
	 * if($bool){
	 */
	if (is_dir ( $mediaPath )) {
		array_map ( 'unlink', glob ( $mediaPath . "*" ) );
		rmdir ( $mediaPath );
	} else if (file_exists ( $mediaPath )) {
		unlink ( $mediaPath );
	}
	/* } */
}

/**
 * This function is used to upload file.
 *
 * @param file -Upload File
 * @param string - Destination ENV Variable
 *
 * @return string - Uploaded Filename
 *
 */
function saveMedia($file, $destinationENVPath) {
	$destinationPath = public_path ( env ( $destinationENVPath ) );
	$filename = time () . '.' . $file->getClientOriginalExtension ();
	if ($file->move ( $destinationPath, $filename )) {
		return $filename;
	} else {
		return "";
	}
}

/**
 * This function is used to return classname based on URL patterns provided.
 * 
 * @param string - URL path or pattenr to match
 * @param string - Active class to be returned if path matches
 * @param string - Inactive class to be returned if path does not match
 *
 * @return string - Class name (Active/Inactive) based on 
 * 
 */
function setActive($path, $active = 'active', $inactive = '') {
	 return call_user_func_array('Request::is', (array)$path) ? $active : $inactive;
}