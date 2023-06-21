<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PharmacyService;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    protected $pharmacyService;

    public function __construct(PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    public function index()
    {
        $pharmacies = $this->pharmacyService->getAllPharmacies();
        return view('pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        return view('pharmacies.create');
    }

    public function store(Request $request)
    {
        $this->pharmacyService->createPharmacy($request->all());
        return redirect()->route('pharmacies.index');
    }

    public function show($id)
    {
        $pharmacy = $this->pharmacyService->getPharmacyById($id);
        return view('pharmacies.show', compact('pharmacy'));
    }

    public function edit($id)
    {
        $pharmacy = $this->pharmacyService->getPharmacyById($id);
        return view('pharmacies.edit', compact('pharmacy'));
    }

    public function update(Request $request, $id)
    {
        $this->pharmacyService->updatePharmacy($id, $request->all());
        return redirect()->route('pharmacies.index');
    }

    public function destroy($id)
    {
        $this->pharmacyService->deletePharmacy($id);
        return redirect()->route('pharmacies.index');
    }

    public function pharmacyProducts($pharmacyId)
    {
        $products = $this->pharmacyService->getPharmacyProducts($pharmacyId);
        return view('pharmacies.products', compact('products'));
    }
}
