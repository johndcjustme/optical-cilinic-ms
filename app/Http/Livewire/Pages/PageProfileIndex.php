<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Traits\SharedVariables;
use App\Traits\Modal;
use App\Traits\UserActivities;

class PageProfileIndex extends Component
{
    use SharedVariables;
    use Modal;
    use UserActivities;

    public 
        $temp_profile_picture,
        $user_id,
        $user = [
            'image' => '',
            'name' => '',
            'email' => '',
            'mobile' => '',
            'fb' => '',
            'password' => '',
            'role' => '',
            'new_password' => '',
            'confirm_new_password' => '',
        ];

    protected $queryString = [
        'user_id'
    ];

    public function mount()
    {
        $this->temp_profile_picture = asset('temp-profile-gradient.png');
        $current_user_id;

        if (Auth::user()->hasRole('staff')) {
            //set account to default_user/current_user
            $current_user_id = Auth::user()->id; 
        } 
        if (Auth::user()->hasRole('admin')) {
            //modify either admin or staff account
            $current_user_id = empty($this->user_id)
                                    ? Auth::user()->id 
                                    : $this->user_id;
        }

        $current_user = User::findOrFail($current_user_id);

        $this->currentPage = 'overview';
        $this->user['name'] = $current_user->name;
        $this->user['email'] = $current_user->email;
        $this->user['mobile'] = $current_user->mobile;
        $this->user['fb'] = $current_user->facebook;
    
        foreach($current_user->roles as $role) {
            $this->user['role'] .= ' ' . $role->name;
        }
    }

    public function render()
    {
        return view('livewire.pages.page-profile-index');
    }

    public function update_profile()
    {
        $this->validate(
            [
                'user.name' => 'required|max:15',
                'user.email' => 'required|email',
                // 'user.myAvatar' => 'image|mimes:jpeg,png,jpg|max:1024|nullable',
            ], [
                'user.name.required' => 'Required',
                'user.name.max' => 'Max: 15',
                'user.email.required' => 'Required',
                'user.email.email' => 'Enter valid email',
            ]);

        $user_data = [
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'mobile' => $this->user['mobile'],
            'facebook' => $this->user['fb'],
        ];

        try {
            $user = User::select(['id', 'name', 'email'])
                ->findOrFail($this->user_id)
                ->update($user_data);

            $this->trait_user_activity_user_update($this->user['name']);

            $this->toast('success', 'Profile has been successfully updated.');            
            $this->resetErrorBag();    
        } catch(\Exception $wtf) { $this->toastError(); }      
    
    }

    public function update_password()
    {
        $this->validate_password();

        if (Hash::check($this->user['password'], Auth::user()->password)) {
            try {
                $user = User::select(['id', 'password'])
                    ->findOrFail(Auth::user()->id)
                    ->update(['password' => Hash::make($this->user['confirm_new_password'])]);
    
                    $this->trait_user_activity_user_password_update($this->user['name']);
    
                    $this->toast('success', 'Password has been successfully updated.');
                    $this->user['password'] = '';
                    $this->user['new_password'] = '';
                    $this->user['confirm_new_password'] = '';
    
                    $this->resetErrorBag();
            } catch (\Exception $wtf) { $this->toastError(); }
        } 
        else {
            $this->toast('error', 'Your old password did not matched.');
        }
    }

    private function validate_password()
    {
        $this->validate(
            [
                'user.password' => 'required|min:6',
                'user.new_password' => 'required|min:6',
                'user.confirm_new_password' => 'required|min:6|same:user.new_password',
            ], [
                'user.password.required' => 'Required',
                'user.new_password.required' => 'Required',
                'user.confirm_new_password.required' => 'Required',
                
                'user.password.min' => 'Min: 6',
                'user.new_password.min' => 'Min: 6',
                'user.confirm_new_password.min' => 'Min: 6',

                'user.confirm_new_password.same' => 'Your new password did not match.',
            ]);
    }
}
