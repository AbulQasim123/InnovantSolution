@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <button
                        type="button"
                        wire:click="previousPage"
                        wire:loading.attr="disabled"
                        class="page-link"
                        aria-label="Previous"
                    >
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <button
                                type="button"
                                wire:click="gotoPage({{ $page }})"
                                class="page-link"
                            >
                                {{ $page }}
                            </button>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button
                        type="button"
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="page-link"
                        aria-label="Next"
                    >
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
