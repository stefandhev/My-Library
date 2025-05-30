<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        if (Auth::user() && Auth::user()->role === 'admin') {
            // Untuk admin
            $loans = Loan::with(['user', 'book'])->latest()->get();
            return view('admin.loans', compact('loans'));
        } else {
            $loans = Loan::with('book')->where('user_id', Auth::user()->id)->latest()->get();
            return redirect()->route('dashboard')->with('loans', $loans);
        }
    }

    public function create()
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.createLoan', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_at',
        ]);

        $validated['status'] = 'borrowed';

        Loan::create($validated);
        return redirect()->back()->with('success', 'Loan request submitted!');
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $users = User::all();
        $books = Book::all();
        return view('admin.editLoan', compact('loan', 'users', 'books'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_at',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
            'status' => 'required|in:borrowed,late,returned',
        ]);

        $loan->update($validated);
        return redirect()->route('admin.loans')->with('success', 'Loan updated successfully.');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('admin.loans')->with('success', 'Loan deleted successfully.');
    }

    public function return(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $validated = $request->validate([
            'returned_at' => 'required|date|after_or_equal:borrowed_at',
        ]);

        $loan->update([
            'returned_at' => $validated['returned_at'],
            'status' => 'returned',
        ]);

        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    public function userLoans($userId)
    {
        $loans = Loan::where('user_id', $userId)->with(['book'])->latest()->get();
        return view('users.myLoans', compact('loans'));
    }

    public function show($id)
    {
        $loan = Loan::with(['user', 'book'])->findOrFail($id);
        return view('admin.loanDetail', compact('loan'));
    }

    public function overdueLoans()
    {
        $overdueLoans = Loan::overdue()->with(['user', 'book'])->get();
        return view('admin.overdueLoans', compact('overdueLoans'));
    }

    public function lateLoans()
    {
        $lateLoans = Loan::late()->with(['user', 'book'])->get();
        return view('admin.lateLoans', compact('lateLoans'));
    }

    public function returnedLoans()
    {
        $returnedLoans = Loan::returned()->with(['user', 'book'])->get();
        return view('admin.returnedLoans', compact('returnedLoans'));
    }
}