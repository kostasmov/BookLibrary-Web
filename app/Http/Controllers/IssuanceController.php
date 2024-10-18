<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IssuanceController extends Controller
{
    public function index(): View
    {
        $issuances = Issuance::paginate(8);
        return view('issuances', compact('issuances'));
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'issuanceId' => 'required|integer|exists:issuances,id',
            'status' => 'required|string|in:pending,issued,rejected,returned',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $issuance = Issuance::find($request->issuanceId);

        switch ($request->status) {
            case 'issued':
                $issuance->book_date = (new DateTime())->format('Y-m-d');
                $issuance->return_date = (new DateTime())->modify('+1 month')->format('Y-m-d');
                break;
            case 'returned':
                $issuance->return_date = (new DateTime())->format('Y-m-d');
                break;
            case 'rejected':
                $issuance->book_date = (new DateTime())->format('Y-m-d');
                $issuance->return_date = (new DateTime())->format('Y-m-d');
                break;
            default:
                break;
        }

        $issuance->status = $request->status;
        $issuance->save();

        return response()->json([
            'message' => 'Успешно обновлено',
            'issuance' => $issuance,
        ]);
    }
}
