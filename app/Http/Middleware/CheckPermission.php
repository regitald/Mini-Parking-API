<?php

namespace App\Http\Middleware;

use Closure;
use Session;;
use App\Http\Traits\GeneralServices;

class CheckPermission
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	use GeneralServices;
	public function handle($request, Closure $next)
	{
		$uri = request()->segment(2);
		$menu = request()->segment(3);
		if(empty($menu)){
			$menu ="view";
		}
		if($menu=="check-in" || $menu=="check-out" ||  $menu=="filter" ){
			$menu ="create";
		}
		if (empty($data)) {
			$validatePermission = $this->validatePermission($uri, $menu);
			if (empty($validatePermission)) {
				echo "<script type='text/javascript'>alert('You dont have permission to acces this page');
						window.location.href='/admin/profile';
				</script>";
			}

		} 
		return $next($request);
		
	}
}
