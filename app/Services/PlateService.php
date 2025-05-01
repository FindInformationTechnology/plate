<?php


namespace App\Services;

use App\Models\Plate;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PlateService
{
    /**
     * Get all users
     *
     * @return Collection
     * 
     * 
     */

    public function __construct(Plate $plate)
    {
        //  $this->model = $plate;  
    }

    public function getAllPlates(): Collection
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {

            return Plate::all();
        }

        if ($user->hasRole('user')) {

            return Plate::where('user_id', $user->id)->get();
        }

        return collect();
    }

    public function createPlate(array $data): Plate
    {
        $user = Auth::user();

        $plate = Plate::create([
            'user_id' => $user->id,
            'code' => $data['code'],
            'length' => $data['length'],
            'number' => $data['number'],
            'image' => $data['image'],
            'pirce' => $data['pirce'],
        ]);

        $plate->save();

        return $plate;
    }

    public function updatePlate(array $data, $plateId): Plate
    {
        $user = Auth::user();

        $plate = Plate::findOrFail($plateId);

        // Check permissions based on user role
        if ($user->hasRole('admin')) {
            // Admin can edit any plate
        } elseif ($user->hasRole('user') && $plate->user_id !== $user->id) {
            // Regular users can only edit their own plates

            throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to edit this plate');
        }

        // Update plate with validated data
        $plate->update([
            'code' => $data['code'],
            'length' => $data['length'],
            'number' => $data['number'],
            'image' => $data['image'] ?? $plate->image,
            'price' => $data['price'] ?? $data['pirce'], // Handle both spellings
        ]);

        return $plate;

    }

      public function deletePlate(array $data) {

        $user = Auth::user();

        $plate = Plate::findOrFail($data['id']);

        if ($user->hasRole('admin') || ($user->hasRole('user') && $plate->user_id === $user->id)) {
            $plate->delete();
            return true;
              
        }else {
            throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to delete this plate');
        }

        

      }





}
