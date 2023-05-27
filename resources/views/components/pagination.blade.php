@php
$totalRecords = $resultList->total();
$perPage = $resultList->perPage();
$totalPageCount = $resultList->count();
$currentPage = $resultList->currentPage();

@endphp

<div class="mt-[15px]">
    @if($totalRecords > config('constants.RECORD_PER_PAGE'))
        {{ $resultList->appends(app('request')->input())->onEachSide(1)->links() }}
    @else
    <p class="text-sm text-gray-700 leading-5">
        Showing <span class="font-medium">{{ $totalPageCount }}</span> results
    </p>
    @endif
</div>