<x-layout>
    @include("partials._hero")
    @include("partials._search")

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if (count($listings) > 0)
            <div class="col-span-2 text-center">
                <p class="text-lg font-bold">No Gig Posted</p>
            </div>
        @else
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach
        @endif
    </div>

    <div class="mt-4 p-6">
        {{$listings->links()}}
    </div>
</x-layout>
