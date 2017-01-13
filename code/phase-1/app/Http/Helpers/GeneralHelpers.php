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
function saveMedia($file, $destinationENVPath) {
	$destinationPath = public_path ( env ( $destinationENVPath ) );
	$filename = time () . '.' . $file->getClientOriginalExtension ();
	if ($file->move ( $destinationPath, $filename )) {
		return $filename;
	} else {
		return "";
	}
}