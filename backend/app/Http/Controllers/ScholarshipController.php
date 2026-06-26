<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    //Landing page (la liste des bourses)
    public function index()
    {
        $scholarships = Scholarship::latest()->get();
        return response()->json([
            'success' => true,
            'data' => $scholarships
        ]);
    }

    //Detail d'une bourse
    public function show($id)
    {
        $scholarship = Scholarship::find($id);
        if(!$scholarship){
            return response()->json([
                'success' => false,
                'message' => 'Scholarship not found'
            ], 404);
        }
        return respose()->json([
            'success' => true,
            'data' => $scholarship
        ]);
    }

    // Recherche
    public function search(Request $request)
    {
        $query = Scholarship::query();
        if($request->filled('country')){
            $query->where('country', 'LIKE', '%' . $request->country . '%');
        }
        if($request->filled('field')){
            $query->where('field', 'LIKE', '%' . $request->field . '%');
        }
        if($request->filled('university')){
            $query->where('university', 'LIKE', '%' . $request->university . '%');
        }

        $results  = $query->orderBy('deadline', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }
}
