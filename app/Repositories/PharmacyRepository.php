<?php

namespace App\Repositories;

use App\Models\Pharmacy;

class PharmacyRepository
{
    public function all()
    {
        return Pharmacy::all();
    }

    public function find($id)
    {
        return Pharmacy::find($id);
    }

    public function create($data)
    {
        return Pharmacy::create($data);
    }

    public function update($id, $data)
    {
        return Pharmacy::find($id)->update($data);
    }

    public function delete($id)
    {
        return Pharmacy::find($id)->delete();
    }

    public function getPharmacyProducts($pharmacyId)
    {
        return Pharmacy::find($pharmacyId)
            ->products()
            ->get();
    }
}
