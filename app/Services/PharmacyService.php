<?php

namespace App\Services;

use App\Repositories\PharmacyRepository;

class PharmacyService
{
    protected $pharmacyRepository;

    public function __construct(PharmacyRepository $pharmacyRepository)
    {
        $this->pharmacyRepository = $pharmacyRepository;
    }

    public function getAllPharmacies()
    {
        return $this->pharmacyRepository->all();
    }

    public function getPharmacyById($id)
    {
        return $this->pharmacyRepository->find($id);
    }

    public function createPharmacy($data)
    {
        return $this->pharmacyRepository->create($data);
    }

    public function updatePharmacy($id, $data)
    {
        return $this->pharmacyRepository->update($id, $data);
    }

    public function deletePharmacy($id)
    {
        return $this->pharmacyRepository->delete($id);
    }

    public function getPharmacyProducts($pharmacyId)
    {
        return $this->pharmacyRepository->getPharmacyProducts($pharmacyId);
    }
}
