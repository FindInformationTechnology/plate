<?php


namespace App\Services;

use App\Models\Plate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Model;

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
         return Plate::all();
     }

   //   public function createPlate(array $data): Plate
   //   {
          
   //   }

   //   public function updatePlate(array $data): Plate
   //   {    
   //   }

   //   public function deletePlate(array $data): Plate {

   //   }





}