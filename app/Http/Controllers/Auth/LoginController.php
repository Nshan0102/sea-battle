<?php

namespace App\Http\Controllers\Auth;

use App\Events\OpponentLeft;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function logout(Request $request)
    {
        $user = auth()->user();

        if ($user->opponentRoom) {
            $room = $user->opponentRoom;
            if ($room->owner){
                event(new OpponentLeft($room->owner, $user));
            }
            $room->update([
                'opponent_id' => null,
                'opponent_ships' => null,
                'turn' => $room->owner->id,
                'ready' => false
            ]);
        } elseif ($user->ownerRoom) {
            $room = $user->ownerRoom;
            if ($room->opponent){
                event(new OpponentLeft($room->opponent, $user));
            }
            $room->delete();
        }

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }
}
