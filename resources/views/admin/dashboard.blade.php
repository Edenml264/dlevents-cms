@extends('admin.layouts.admin')

@section('header')
    Dashboard
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Leads</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['total_leads'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Leads Este Mes</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['leads_this_month'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Valor Potencial</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">${{ number_format($stats['potential_value']) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Tasa de Conversión</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['conversion_rate'] }}%</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900">Leads por Mes</h3>
            <canvas id="leadsChart" class="mt-4"></canvas>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900">Estado de Leads</h3>
            <canvas id="statusChart" class="mt-4"></canvas>
        </div>
    </div>

    <!-- Recent Leads & Upcoming Events -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Leads Recientes</h3>
                <div class="mt-4 space-y-4">
                    @foreach($recentLeads as $lead)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $lead->name }}</p>
                            <p class="text-sm text-gray-500">{{ $lead->created_at->format('d/m/Y') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $lead->status_color }}">
                            {{ $lead->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Próximos Eventos</h3>
                <div class="mt-4 space-y-4">
                    @foreach($upcomingEvents as $event)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $event->event_type }}</p>
                            <p class="text-sm text-gray-500">{{ $event->event_date->format('d/m/Y') }}</p>
                        </div>
                        <p class="text-sm text-gray-500">{{ $event->name }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Leads por mes
    const monthlyData = @json($leadsByMonth);
    new Chart(document.getElementById('leadsChart'), {
        type: 'line',
        data: {
            labels: monthlyData.map(d => d.month),
            datasets: [{
                label: 'Leads',
                data: monthlyData.map(d => d.total),
                borderColor: '#4F46E5',
                tension: 0.1
            }]
        }
    });

    // Estado de leads
    const statusData = @json($leadsByStatus);
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.map(d => d.status),
            datasets: [{
                data: statusData.map(d => d.total),
                backgroundColor: [
                    '#4F46E5', // Nuevo
                    '#10B981', // En Proceso
                    '#F59E0B', // Pendiente
                    '#EF4444'  // Cerrado
                ]
            }]
        }
    });
</script>
@endpush
@endsection