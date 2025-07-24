<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\{
    Title,
    Layout,
};

#[Layout('admin.layouts.app')]
#[Title('Profile')]
class Profile extends Component
{
    public $name, $email, $password;

    public function mount()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('load.login');
        }

        $this->name = $user->name;
        $this->email = $user->email;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:5',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'Email already exists.',
            'password.min' => 'Password must be at least 5 characters.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateProfile()
    {
        $this->validate();
        sleep(1);
        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->dispatch(
            'data-added',
            title: 'Success',
            message: 'Profile Updated successfully.',
            redirectUrl: route('profile')
        );
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
