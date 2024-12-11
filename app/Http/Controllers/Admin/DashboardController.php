<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'total_leads' => Lead::count(),
            'leads_this_month' => Lead::whereMonth('created_at', now()->month)->count(),
            'potential_value' => Lead::whereNotNull('budget')->sum('budget'),
            'conversion_rate' => $this->calculateConversionRate(),
        ];

        // Distribución por estado
        $leadsByStatus = Lead::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Leads por mes (últimos 6 meses)
        $leadsByMonth = Lead::select(
            DB::raw("strftime('%Y-%m', created_at) as month"),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Leads recientes
        $recentLeads = Lead::latest()
            ->take(5)
            ->get();

        // Próximos eventos
        $upcomingEvents = Lead::where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'leadsByStatus',
            'leadsByMonth',
            'recentLeads',
            'upcomingEvents'
        ));
    }

    private function calculateConversionRate()
    {
        $totalLeads = Lead::count();
        if ($totalLeads === 0) return 0;

        $convertedLeads = Lead::where('status', 'convertido')->count();
        return round(($convertedLeads / $totalLeads) * 100, 1);
    }
}
