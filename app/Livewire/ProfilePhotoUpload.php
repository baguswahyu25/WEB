<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfilePhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {
        Log::info('ProfilePhotoUpload save() method called');

        $this->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        Log::info('Validation passed');

        $user = Auth::user();

        Log::info('User ID: ' . $user->id);

        if ($this->photo) {
            Log::info('Photo file exists');
            $file = $this->photo;

            if (!$file->isValid()) {
                Log::error('File is not valid');
                session()->flash('error', 'File upload tidak valid');
                return;
            }

            $filename = 'profile_' . $user->id . '_' . Str::random(20) . '.' . $file->extension();
            Log::info('Generated filename: ' . $filename);

            $path = $file->storeAs('profile-photos', $filename, 'public');
            Log::info('Stored path: ' . $path);

            if (!Storage::disk('public')->exists($path)) {
                Log::error('File not found after storage: ' . $path);
                session()->flash('error', 'Gagal menyimpan foto');
                return;
            }

            Log::info('File successfully stored');

            // Hapus foto lama jika ada
            if ($user->profile_photo_path &&
                Storage::disk('public')->exists($user->profile_photo_path)) {
                Log::info('Deleting old photo: ' . $user->profile_photo_path);
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $path;
            Log::info('Updated user profile_photo_path: ' . $path);
        } else {
            Log::info('No photo file uploaded');
        }

        $user->save();
        Log::info('User saved successfully');

        session()->flash('message', 'Foto profil berhasil diupdate.');

        // Reset form
        $this->photo = null;
    }

    public function render()
    {
        return view('livewire.profile-photo-upload');
    }
}
