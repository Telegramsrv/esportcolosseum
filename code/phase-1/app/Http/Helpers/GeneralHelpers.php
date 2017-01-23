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
 * This function is used to upload file.
 *
 * @param file - remove Filename
 * @param string - Destination ENV Variable
 *
 *
 */

function removeMedia($file, $destinationENVPath) {
	$destinationPath = public_path(env($destinationENVPath));
	$mediaPath = $destinationPath.$file;
	if (file_exists ( $mediaPath )) {
		unlink ( $mediaPath );
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

function setParentActive($path, $active = 'active', $inactive = '')
{
	return  (Request::is($path . '/*') || Request::is($path)) ? $active : $inactive;
}

/**
 * This function is used to return classname based on URL patterns provided for pages in which we have game navigation in left side bar.
 * 
 * @param string - game slug
 * @param string - Active class to be returned if path matches
 * @param string - Inactive class to be returned if path does not match
 *
 * @return string - Class name (Active/Inactive) based on 
 * 
 */

function setNavigationForGame($gameSlug, $activeClass="active", $inactiveClass = "inactive"){
	$navigations = array();
	$route = Route::current();
	$currentGame = $route->getParameter('gameSlug', env('DEFAULT_GAME_SLUG', 'counter-strike'));

	// Get current route parameters.
	$parameters = $route->parameters();

	$parameters['gameSlug']		= $gameSlug;
	if(isset($parameters['md5UserId'])){
		$parameters['md5UserId']	= md5($parameters['md5UserId']->id);
	}

	$navigation = array(
		'url' => route($route->getName(), $parameters),
		'class' => ($currentGame->slug == $gameSlug ? $activeClass : $inactiveClass)
	);		
	
	return $navigation;
}

function findDateDifferenceInHours($endDateTime){
	$currentDateTime 	= Carbon\Carbon::now();
	$diffInHours 		= $endDateTime->diffInHours($currentDateTime);
	$diffInMinues 		= $endDateTime->diffInMinutes($currentDateTime);
	$diffInSeconds 		= $endDateTime->diffInSeconds($currentDateTime);

	if($diffInHours > 0){
		return $diffInHours." Hrs";
	}
	else if($diffInMinues > 0){
		return $diffInMinues." Mins";
	}
	else {
		return $diffInSeconds." Secs";
	}
}

function getMenu(){
	$menu = array();

	$menu[] = [
			'id'   => 'dashboard',
			'name' => 'Dashboard',
			'icon' => 'fa fa-home',
			'url' => "#",
			'path' => "admin/dashboard",
			'order' => 0,
	];

	$menu[] = [
			'id'   => 'user-manager',
			'name' => 'User Manager',
			'icon' => 'fa fa-user',
			'url' => "#",
			'path' => "admin/user",
			'order' => 1,
	];

	$menu[] = [
			'id'   => 'blog-manager',
			'name' => 'Blog Manager',
			'icon' => 'fa fa-rss-square',
			'url' => "#",
			'path' => "admin/blog",
			'order' => 2,
	];

	$menu[] = [
			'id'   => 'esc-challenge-template-manager',
			'name' => 'Esc Challenge Template Manager',
			'icon' => 'fa fa-trophy',
			'url' => "#",
			'path' => "admin/esc-challenge-template",
			'order' => 3,
	];
	
	$menu[] = [
			'id'   => 'game-manager',
			'name' => 'Game Manager',
			'icon' => 'fa fa-gamepad',
			'url' => "#",
			'path' => "admin/game",
			'order' => 4,
	];
	
	$menu[] = [
			'id'   => 'tickets',
			'name' => 'Tickets',
			'icon' => 'fa fa-ticket',
			'url' => "admin/tickets",
			'path' => "admin/tickets",
			'order' => 5,
	];
	
	$menu[] = [
			'id'   => 'page-manager',
			'name' => 'Page Manager',
			'icon' => 'fa fa-file',
			'url' => "#",
			'path' => "admin/page",
			'order' => 6,
	];

	$menu[] = [
			'id'   => 'matches',
			'name' => 'Match Manager',
			'icon' => 'fa fa-user',
			'url' => "#",
			'path' => "admin/match",
			'order' => 7,
	];
	
	usort($menu, function($a, $b) {
		return $a['order'] - $b['order'];
	});

		return $menu;
}


function getSubMenu($menuName){
	$submenu = array();

	$submenu['user-manager'][] = [
			'name' => 'User List',
			'url' => 'admin/user',
			'route'=> 'admin.user.list',
	];
	$submenu['user-manager'][] = [
			'name' => 'Add New User',
			'url' => 'admin/user/add',
			'route'=> 'admin.user.add',
	];

	$submenu['blog-manager'][] = [
			'name' => 'Blogs',
			'url' => 'admin/blog',
			'route'=> 'admin.blog.list',
	];
	$submenu['blog-manager'][] = [
			'name' => 'Add New Blog',
			'url' => 'admin/blog/add',
			'route'=> 'admin.blog.add',
	];

	$submenu['esc-challenge-template-manager'][] = [
			'name' => 'Esc Challenge Templates',
			'url' => 'admin/esc-challenge-template',
			'route'=> 'admin.esc-challenge-template.list',
	];
	$submenu['esc-challenge-template-manager'][] = [
			'name' => 'Add New Esc Challenge Template',
			'url' => 'admin/esc-challenge-template/add',
			'route'=> 'admin.esc-challenge-template.add',
	];

	$submenu['game-manager'][] = [
			'name' => 'Games',
			'url' => 'admin/game',
			'route'=> 'admin.game.list',
	];
	$submenu['game-manager'][] = [
			'name' => 'Add New Game',
			'url' => 'admin/game/add',
			'route'=> 'admin.game.add',
	];
	$submenu['page-manager'][] = [
			'name' => 'Pages',
			'url' => 'admin/page',
			'route'=> 'admin.page',
	];
	$submenu['page-manager'][] = [
			'name' => 'Add New Page',
			'url' => 'admin/page/add',
			'route'=> 'admin.page.add',
	];
	$submenu['matches'][] = [
			'name' => 'Match List',
			'url' => 'admin/match',
			'route'=> 'admin.match.list',
	];
	/* $submenu['matches'][] = [
			'name' => 'Add New Match',
			'url' => 'admin/match/add',
			'route'=> 'admin.match.add',
	]; */

	if(isset($submenu[$menuName])){
		return $submenu[$menuName];
	}
	else{
		return array();
	}

}
