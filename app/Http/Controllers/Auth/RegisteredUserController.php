<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Get the job seeker role (default role for new users)
        $jobSeekerRole = \App\Models\Role::where('name', 'jobseeker')->first();
        
        if (!$jobSeekerRole) {
            // If role doesn't exist, create it
            $jobSeekerRole = \App\Models\Role::create([
                'name' => 'jobseeker',
                'description' => 'Job seeker who can apply for jobs and manage profile'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $jobSeekerRole->id, // Assign job seeker role by default
        ]);

        // Create a job seeker profile for the user
        \App\Models\job_seekers::create([
            'user_id' => $user->id,
            'bio' => null,
            'current_position' => null,
            'experience_years' => 0,
            'availability_status' => 'immediately',
            'location_preference' => null,
            'remote_preference' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
