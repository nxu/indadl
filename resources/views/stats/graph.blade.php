@extends('stats.layout')

@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="font-serif font-bold text-5xl mb-12">{{ $title }}</h1>

        <div class="bg-white border-gray-50 rounded-md shadow-md py-4 px-4">
            <canvas id="chart"></canvas>
        </div>
    </div>
@endsection


@section('scripts')
    @php
        $backgrounds = [
            200 => '#bef264',
            400 => '#93c5fd',
            500 => '#f87171',
        ];
    @endphp
<script>
    const labels = {!! json_encode($labels) !!};
    const data = {
        labels: labels,
        datasets: [
            @foreach($data as $response => $datapoints)
            {
                label: 'HTTP {{ $response }}',
                data: {!! json_encode($datapoints) !!},
                backgroundColor: '{{ \Illuminate\Support\Arr::get($backgrounds, $response) }}',
            },
            @endforeach
        ]
    };

    new Chart(document.getElementById('chart'), {
        type: 'bar',
        data: data,
    });
</script>
@endsection
