@extends('stats.layout')

@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="font-serif font-bold text-5xl mb-12">IndaDL statisztika</h1>

        <div class="flex gap-6">
            <div class="w-full lg:w-1/2 xl:w-1/4">
                @component('stats.components.summary-card')
                    <h2 class="font-serif font-bold text-2xl mb-1">
                        Utolsó 24 óra
                    </h2>

                    <p class="mb-3">
                        <a href="/stats/24h" class="underline text-blue-500 text-sm">Részletek</a>
                    </p>

                    @foreach($last24h as $row)
                        <p class="flex">
                            <span class="font-bold">{{ $row->response }}</span>
                            <span class="ml-auto text-right">{{ number($row->requests) }}</span>
                        </p>
                    @endforeach
                    <p class="flex border-t border-gray-300 mt-2">
                        <span class="font-bold">Összesen</span>
                        <span class="font-bold ml-auto text-right">{{ number($last24h->sum('requests')) }}</span>
                    </p>
                @endcomponent
            </div>

            <div class="w-full lg:w-1/2 xl:w-1/4">
                @component('stats.components.summary-card')
                    <h2 class="font-serif font-bold text-2xl mb-1">
                        Utolsó 7 nap
                    </h2>

                    <p class="mb-3">
                        <a href="/stats/7d" class="underline text-blue-500 text-sm">Részletek</a>
                    </p>

                    @foreach($last7d as $row)
                        <p class="flex">
                            <span class="font-bold">{{ $row->response }}</span>
                            <span class="ml-auto text-right">{{ number($row->requests) }}</span>
                        </p>
                    @endforeach
                    <p class="flex border-t border-gray-300 mt-2">
                        <span class="font-bold">Összesen</span>
                        <span class="font-bold ml-auto text-right">{{ number($last7d->sum('requests')) }}</span>
                    </p>
                @endcomponent
            </div>

            <div class="w-full lg:w-1/2 xl:w-1/4">
                @component('stats.components.summary-card')
                    <h2 class="font-serif font-bold text-2xl mb-1">
                        Utolsó 14 nap
                    </h2>
                    <p class="mb-3">
                        <a href="/stats/14d" class="underline text-blue-500 text-sm">Részletek</a>
                    </p>

                    @foreach($last14d as $row)
                        <p class="flex">
                            <span class="font-bold">{{ $row->response }}</span>
                            <span class="ml-auto text-right">{{ number($row->requests) }}</span>
                        </p>
                    @endforeach
                    <p class="flex border-t border-gray-300 mt-2">
                        <span class="font-bold">Összesen</span>
                        <span class="font-bold ml-auto text-right">{{ number($last14d->sum('requests')) }}</span>
                    </p>
                @endcomponent
            </div>

            <div class="w-full lg:w-1/2 xl:w-1/4">
                @component('stats.components.summary-card')
                    <h2 class="font-serif font-bold text-2xl mb-5">
                        Top IP-k
                    </h2>

                    @foreach($ips as $row)
                        <p class="flex">
                            <span class="font-bold text-sm">{{ $row->ip }}</span>
                            <span class="ml-auto text-right whitespace-nowrap">{{ number($row->requests) }}</span>
                        </p>
                    @endforeach
                @endcomponent
            </div>
        </div>
    </div>
@endsection
