<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CandidatesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $month;
    protected $search;

    public function __construct($month = null, $search = null)
    {
        $this->month = $month;
        $this->search = $search;
    }

    /**
     * Return the collection of candidates to export
     */
    public function collection()
    {
        $query = Candidate::with('user');

        // Apply search filter
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%");
                  });
            });
        }

        // Apply month filter
        if ($this->month) {
            $query->whereMonth('created_at', $this->month);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Joining Date',
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($candidate): array
    {
        return [
            $candidate->name ?? 'N/A',
            $candidate->user->email ?? 'N/A',
            $candidate->phone ?? 'N/A',
            $candidate->created_at->format('M d, Y'),
        ];
    }
}
