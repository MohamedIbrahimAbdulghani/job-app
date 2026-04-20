<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request) {
        $query = JobVacancy::query();

        // contaction between filter and search
        if($request->has('search') && $request->has('filter')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhereHas('company', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
            })->where('type', $request->filter);
        }

        // to make search input to search about job vacancies
        if($request->has('search') && $request->filter === null) {
            $query->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('location', 'like', '%' . $request->search . '%')
            ->orWhereHas('company', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if($request->has('filter') && $request->search === null) {
            $query->where('type', $request->filter);
        }

        // $jobs = $query->latest()->paginate(5)->withQueryString();
        $jobs = $query->latest()->paginate(5)->withQueryString();
        return view('dashboard', compact('jobs'));
    }
}