<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PharmacyService;
use Illuminate\Http\Request;

class PharmacyApiController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    public function index()
    {
        $pharmacies = $this->pharmacyService->getAllPharmacies();
        return response()->json($pharmacies);
    }

    public function store(Request $request)
    {
        $pharmacy = $this->pharmacyService->createPharmacy($request->all());
        return response()->json($pharmacy, 201);
    }

    public function show($id)
    {
        $pharmacy = $this->pharmacyService->getPharmacyById($id);
        return response()->json($pharmacy);
    }

    public function update(Request $request, $id)
    {
        $this->pharmacyService->updatePharmacy($id, $request->all());
        return response()->json(['message' => 'Pharmacy updated successfully']);
    }

    public function destroy($id)
    {
        $this->pharmacyService->deletePharmacy($id);
        return response()->json(['message' => 'Pharmacy deleted successfully']);
    }

    public function pharmacyProducts($pharmacyId)
    {
        $products = $this->pharmacyService->getPharmacyProducts($pharmacyId);
        return response()->json($products);
    }
}
