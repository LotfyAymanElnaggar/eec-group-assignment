<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PharmacyService;
use Illuminate\Http\Request;
use App\Repositories\PharmacyRepository;
use Illuminate\Database\QueryException;

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

    public function attachProduct(Request $request, PharmacyRepository $pharmacyRepo, $pharmacyId)
    {
        $productId = $request->input('product_id');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        $pharmacy = $pharmacyRepo->find($pharmacyId);

        if (!$pharmacy) {
            return response()->json([
                'success' => false,
                'message' => 'Pharmacy or product not found.',
            ], 404);
        }

        try {
            $pharmacyRepo->attachProduct($pharmacy, $productId, $price, $quantity);
        } catch (QueryException  $e) {
            // Handle cases where an SQL error occurs, such as a duplicate key constraint violation
            if ($e->getCode() == 23000) {
                return $e;
                return response()->json([
                    'success' => false,
                    'message' => 'No product with this Id or The product is already attached to the pharmacy.',
                ], 409);
            }

            // Handle other database errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while attaching the product to the pharmacy.',
            ], 500);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
            ], 500);
        }

        return response()->json(['message' => 'Product attached to pharmacy successfully'], 200);
    }
}
