<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $people = Person::all();
        return response()->json([
            'success' => true,
            'data' => $people
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $person = Person::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Person created successfully',
            'data' => $person
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $person
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer|min:0',
            'contact' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
        ]);

        $person->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Person updated successfully',
            'data' => $person
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person): JsonResponse
    {
        $person->delete();

        return response()->json([
            'success' => true,
            'message' => 'Person deleted successfully'
        ], 200);
    }
}
