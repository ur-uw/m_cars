<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $street_address;
    public $city;
    public $state;
    public $postal_code;
    public $country;
    public $bio;
    public $user_image;
    public $user_image_file;
    public function mount()
    {
        // Get the user's profile data
        $user = auth()->user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->user_image = $user->image;
        // Get the user's address data if address is not null
        if ($user->address) {
            $this->street_address = $user->address->street;
            $this->city = $user->address->city;
            $this->state = $user->address->state;
            $this->postal_code = $user->address->postal_code;
            $this->country = $user->address->country;
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public  function updateProfile(string $userForm)
    {
        $newUserData = [];
        if ($userForm == 'personalInfo') {
            $this->validate($this->rules);
            // Update the user's personal info and address
            $newUserData = [
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
            ];
            $addressData = [
                'street' => $this->street_address,
                'city' => $this->city,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
                'country' => $this->country,
            ];
            Address::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                ],
                $addressData
            );
        } else {
            $this->rules = [
                'user_image_file' =>
                'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'bio' => 'nullable|string:max:255',
            ];
            $this->validate($this->rules);
            // Update the user's bio
            $newUserData = [
                'bio' => $this->bio,
            ];

            if ($this->user_image_file != null) {
                $newUserData['image'] = $this->user_image_file->store('public/images');
            }
        }
        User::where('id', auth()->id())->update($newUserData);
        session()->flash('success', 'Profile updated successfully!');
        $this->emit('profile_updated');
    }

    protected $rules = [
        'first_name' => 'required|min:3|string',
        'last_name' => 'required|min:3|string',
        'email' => 'required|email',
        'country' => 'required',
        'city' => 'required',
        'state' => 'required',
        'postal_code' => 'required|numeric',
        'street_address' => 'required|string',

    ];
    public function render()
    {
        return view('livewire.profile')
            ->extends('layouts.app');
    }
}
