<?php
class AuthController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
	    if(Sentry::check())
	    	return Redirect::route('home.index');

		return View::make('auth.login');
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::route('login');
	}

	public function authenticate()
	{
		$rules = array(
			'username' => 'required',
			'password' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return Redirect::route('login')->withErrors($validator);
		}
		else
		{
			try
			{
			    // Set login credentials
			    $credentials = array(
			        'username' => Input::get('username'),
			        'password' => Input::get('password')
			    );

			    // Try to authenticate the user. Set remember flag to false
			    $user = Sentry::authenticate($credentials, false);

			    if(Sentry::check()) {
							Cookie::queue('chit', array('indent'=>array(), 'requirement'=>array()), 60);
							Cookie::queue('chit_size', array('indent'=>0, 'requirement'=>0), 60);
					    	return Redirect::route('home.index');
			    }
			    else {
			    	return Redirect::route('login')
			    		->with('error', _('Login failed. Please check your credentials.'));
			    }
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
			catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
			  	return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
			catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
			{
			    return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			    return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
			// The following is only required if throttle is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				$suspension_time = Config::get('cartalyst/sentry::throttling.suspension_time');
				$minutes = $suspension_time>1?'minutes':'minute';
			    return Redirect::route('login')
			    	->with('error', sprintf(_('Your account has been suspended due to multiple login attempts. Please try again after %d %s.'), $suspension_time, $minutes) );
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
			    return Redirect::route('login')->with('error', _('Login failed. Please check your credentials.'));
			}
		}
	}
}