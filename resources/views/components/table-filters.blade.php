@props([
    'filters' => [],
    'sortOptions' => [],
    'placeholder' => 'Cari data...',
])

@php
    $search = $filters['search'] ?? '';
    $sort = $filters['sort'] ?? array_key_first($sortOptions);
    $direction = $filters['direction'] ?? 'desc';
    $hasFilter = $search || $sort !== array_key_first($sortOptions) || $direction !== 'desc';
@endphp

<form method="GET" style="margin-bottom: 18px; border-bottom: 1px solid #e4e4e7; padding-bottom: 14px;">
    <div style="display: grid; grid-template-columns: minmax(260px, 1fr) 160px 190px 46px {{ $hasFilter ? 'auto' : '' }}; gap: 10px; align-items: center; width: 100%;">
        <input
            id="table-search"
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            style="height: 42px; width: 100%; min-width: 0; border: 1px solid #d4d4d8; border-radius: 10px; background: #ffffff; padding: 0 14px; font-size: 14px; color: #18181b; outline: none; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.04);"
            onfocus="this.style.borderColor='#71717a'; this.style.boxShadow='0 0 0 3px rgba(113,113,122,0.14)';"
            onblur="this.style.borderColor='#d4d4d8'; this.style.boxShadow='0 1px 2px 0 rgb(0 0 0 / 0.04)';"
        />

        <select
            id="table-sort"
            name="sort"
            aria-label="Urutkan"
            style="height: 42px; width: 160px; border: 1px solid #d4d4d8; border-radius: 10px; background-color: #ffffff; padding: 0 12px; font-size: 14px; color: #3f3f46; outline: none; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.04);"
            onfocus="this.style.borderColor='#71717a'; this.style.boxShadow='0 0 0 3px rgba(113,113,122,0.14)';"
            onblur="this.style.borderColor='#d4d4d8'; this.style.boxShadow='0 1px 2px 0 rgb(0 0 0 / 0.04)';"
        >
            @foreach ($sortOptions as $value => $label)
                <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
            @endforeach
        </select>

        <select
            id="table-direction"
            name="direction"
            aria-label="Arah urutan"
            style="height: 42px; width: 190px; border: 1px solid #d4d4d8; border-radius: 10px; background-color: #ffffff; padding: 0 12px; font-size: 14px; color: #3f3f46; outline: none; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.04);"
            onfocus="this.style.borderColor='#71717a'; this.style.boxShadow='0 0 0 3px rgba(113,113,122,0.14)';"
            onblur="this.style.borderColor='#d4d4d8'; this.style.boxShadow='0 1px 2px 0 rgb(0 0 0 / 0.04)';"
        >
            <option value="desc" @selected($direction === 'desc')>Terbaru / Terbesar</option>
            <option value="asc" @selected($direction === 'asc')>Terlama / Terkecil</option>
        </select>

        <button
            type="submit"
            title="Terapkan filter"
            aria-label="Terapkan filter"
            style="height: 42px; width: 46px; border: 0; border-radius: 10px; background: #18181b; color: #ffffff; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.08);"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 17px; height: 17px; display: block;">
                <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.591l-4.682 4.682A2.25 2.25 0 0 0 12 12.493v3.384a2.25 2.25 0 0 1-1.244 2.013l-1.5.75A.75.75 0 0 1 8.25 18v-5.507a2.25 2.25 0 0 0-.659-1.591L2.909 6.22a2.25 2.25 0 0 1-.659-1.591V2.34a.75.75 0 0 1 .378-.739Z" clip-rule="evenodd" />
            </svg>
        </button>

        @if ($hasFilter)
            <a
                href="{{ url()->current() }}"
                style="height: 42px; border: 1px solid #e4e4e7; border-radius: 10px; background: #ffffff; color: #52525b; display: inline-flex; align-items: center; justify-content: center; padding: 0 13px; font-size: 14px; font-weight: 500; text-decoration: none; white-space: nowrap; box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.04);"
            >
                Reset
            </a>
        @endif
    </div>
</form>
