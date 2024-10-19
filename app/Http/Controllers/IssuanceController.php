<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Mail\IssuanceStatusChanged;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class IssuanceController extends Controller
{
    public function index(): View
    {
        $sort = request('sort', 'issue');
        $search = request('search');

        $issuances = Issuance::query();

        if ($search) {
            $issuances->whereHas('book', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })->orWhereHas('reader', function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            });
        }

        switch ($sort) {
            case 'issue':
                $issuances->orderByRaw('book_date IS NULL DESC')
                    ->orderBy('book_date', 'desc');
                break;
            case 'return':
                $issuances->orderByRaw('return_date IS NULL DESC')
                    ->orderBy('return_date', 'desc');
                break;
            case 'title':
                $issuances->whereHas('book')->join('books', 'books.id', '=', 'issuances.book_id')
                    ->orderBy('books.title');
                break;
            case 'reader':
                $issuances->whereHas('reader')->join('readers', 'readers.id', '=', 'issuances.reader_id')
                    ->orderBy('readers.last_name')
                    ->orderBy('readers.first_name');
                break;
            default:
                $issuances->orderBy('book_date', 'desc');
                break;
        }

        $issuances = $issuances->paginate(8);

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
                $statusMessage = 'Книга выдана';
                break;
            case 'returned':
                $issuance->return_date = (new DateTime())->format('Y-m-d');
                $statusMessage = 'Книга возвращена';
                break;
            case 'rejected':
                $issuance->book_date = (new DateTime())->format('Y-m-d');
                $issuance->return_date = (new DateTime())->format('Y-m-d');
                $statusMessage = 'Выдача книги отклонена';
                break;
            default:
                $statusMessage = 'Неизвестный статус';
                break;
        }

        $issuance->status = $request->status;
        $issuance->save();

        try {
            Log::info('Попытка отправить email на: ' . $issuance->reader->email);
            Mail::to($issuance->reader->email)->send(new IssuanceStatusChanged($issuance, $statusMessage));
            Log::info('Email успешно отправлен.');
        } catch (\Exception $e) {
            Log::error('Ошибка при отправке email: ' . $e->getMessage());
        }

        return response()->json([
            'message' => 'Успешно обновлено',
            'issuance' => $issuance,
        ]);
    }
}
