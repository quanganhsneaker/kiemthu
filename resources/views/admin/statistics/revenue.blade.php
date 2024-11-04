@extends('admin.main')

@section('content')

<canvas id="revenueChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $labels !!},
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: {!! $revenues !!},
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<div class="revenue-info">
    <p>Doanh thu tuần này: {{ number_format($revenueThisWeek, 0, ',', '.') }} VNĐ</p>
</div>
<div class="revenue-info">
    <p>Doanh thu tuần trước: {{ number_format($revenueLastWeek, 0, ',', '.') }} VNĐ</p>
</div>

<div class="revenue-info">
    @if($revenueThisWeek > $revenueLastWeek)
        <p>Doanh thu tuần này tăng so với tuần trước.</p>
    @elseif($revenueThisWeek < $revenueLastWeek)
        <p>Doanh thu tuần này giảm so với tuần trước.</p>
    @else
        <p>Doanh thu tuần này bằng với tuần trước.</p>
    @endif
</div>

@endsection
