<x-layout>
    <x-page-heading>Results</x-page>

        <div class="space-y-6">
            @foreach ($jobs as $job)
            <x-job-card-wide :job="$job" />
            @endforeach
        </div>
</x-layout>