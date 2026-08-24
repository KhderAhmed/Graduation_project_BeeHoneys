<?php

namespace App\Http\Controllers\Berker;

use App\Http\Controllers\Controller;
use App\Models\Hive;
use App\Models\HiveReading;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboradController extends Controller
{
    public function  dash(Request $request)
    {

        $search = $request->input('search');

        $hives = Hive::where('beekeeper_id', auth()->id())
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->with('latestReading')
            ->orderBy('name')
            ->paginate(9);

        return view('Beekeeper.dashboard', compact('hives', 'search'));
    }
    public function index()
    {
        $hives = Hive::all();
        return view('Beekeeper.hives.data-simulator', compact('hives'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hive_id'     => 'required|exists:hives,id',
            'temperature' => 'nullable|numeric',
            'humidity'    => 'nullable|numeric',
            'weight'      => 'nullable|numeric',
            'co2'         => 'nullable|numeric',
        ]);

        HiveReading::create($validated);

        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح!');
    }
    public function show(Hive $hive, Request $request)
    {
        $period = $request->input('period', 'day'); // default period

        $query = $hive->readings()->latest();

        if ($period === 'day') {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        } elseif ($period === 'week') {
            $query->where('created_at', '>=', Carbon::now()->subWeek());
        } elseif ($period === 'month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        }

        $readings = $query->orderBy('created_at')->get();

        $chartData = [
            'labels'      => $readings->pluck('created_at')->map(fn($date) => $date->format('d M H:i'))->toArray(),
            'temperature' => $readings->pluck('temperature')->toArray(),
            'humidity'    => $readings->pluck('humidity')->toArray(),
            'weight'      => $readings->pluck('weight')->toArray(),
        ];

        $latest = $hive->latestReading;

        return view('Beekeeper.hives.detail', compact('hive', 'period', 'chartData', 'latest'));
    }
}
