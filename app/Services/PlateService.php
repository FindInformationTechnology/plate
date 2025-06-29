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
use Str;

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

        // Check permissions based on user role

        if ($user->hasRole('user')) {

            return Plate::where('user_id', $user->id)->get();
        }

        if ($user->hasRole('admin')) {

            return Plate::all();
        }

        return collect();
    }

    public function createPlate(array $data, $request): Plate
    {

        //code...
       
        $data['user_id'] = Auth::user()->id;
      
        $data['length'] = (int) strlen((string) $data['number']); // Default length to 4 if not provi
        // Set default values for checkboxes if not provided
        $data['is_approved'] = $request->has('is_approved') ? 1 : 0;

        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;

        return Plate::create($data);

    }

    public function updatePlate($plateId, array $data): Plate
    {
        $user = Auth::user();

        $plate = Plate::findOrFail($plateId);

        // Check permissions based on user role
        if (($user->hasRole('user') && $plate->user_id == $user->id) || $user->hasRole('admin')) {
            // Admin can edit any plate
            $data['length'] = (int) strlen((string) $data['number']);

            $plate->update($data);

            return $plate;
        }

        throw new \Exception('You do not have permission to edit this plate');
    }

    public function deletePlate($id)
    {

        $user = Auth::user();

        $plate = Plate::findOrFail($id);

        if ($user->hasRole('admin') || ($user->hasRole('user') && $plate->user_id === $user->id)) {
            $plate->delete();
            return true;
        } else {
            throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to delete this plate');
        }
    }

    public function generateCode($length) {}

    public function getPlateById($plateId)
    {

        $user = Auth::user();

        $plate = Plate::findOrFail($plateId);

        if ($user->hasRole('admin') || ($user->hasRole('user') && $plate->user_id === $user->id)) {
            return $plate;
        }

        throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to view this plate');
    }
}
