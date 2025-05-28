<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'due_date', 'returned_at', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function scopeOverdue($query) {
        return $query->where('status', 'borrowed')->where('due_date', '<', now())
        ->whereNull('returned_at');
    }

    public function scopeLate($query) {
        return $query->where('status', 'late')->orWhere(function ($q) {
            $q->where('status', 'borrowed')->whereNull('returned_at')
            ->where('due_date', '<', now());
        });
    }

    public function scopeReturned($query) {
        return $query->where('status', 'returned')->orWhereNotNull('returned_at');
    }

    public function scopeBorrowed($query) {
        return $query->where('status', 'borrowed')->whereNull('returned_at');
    }

    public function scopeWithUserAndBook($query) {
        return $query->with(['user', 'book']);
    }

    protected $casts = ['borrowed_at' => 'datetime', 'due_date' => 'datetime'];

    public function isLate() {
        return $this->status === 'late'||(is_null($this->returned_at) && now()->gt($this->due_date));
    }

    public function isReturned() {
        return $this->status === 'returned'|| !is_null($this->returned_at);
    }
}
