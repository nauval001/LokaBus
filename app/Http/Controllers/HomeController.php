<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::with('author')->latest()->take(3)->get();
        $origins = Schedule::distinct()->pluck('origin');
        $destinations = Schedule::distinct()->pluck('destination');

        return view('welcome', compact('latestArticles', 'origins', 'destinations'));
    }

    public function search(Request $request)
    {
        $query = Schedule::with('bus');

        // Filter berdasarkan inputan pencarian
        if ($request->filled('origin')) {
            $query->where('origin', $request->origin);
        }
        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }
        if ($request->filled('departure_date')) {
            $query->whereDate('departure_time', $request->departure_date);
        }

        $schedules = $query->get();

        return view('tickets.index', compact('schedules', 'request'));
    }
}