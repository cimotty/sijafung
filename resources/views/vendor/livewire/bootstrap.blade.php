<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav class="mt-2 mb-2 mx-4">
            <div class="row">
                <div class="col-xl-6 align-self-center text-center text-lg-start">
                    <p>
                        <span>{!! __('Menampilkan') !!}</span>
                        <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('ke') !!}</span>
                        <span class="fw-bold">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('dari') !!}</span>
                        <span class="fw-bold">{{ $paginator->total() }}</span>
                        <span>{!! __('hasil') !!}</span>
                    </p>
                </div>
                <div class="col-xl-6 d-flex justify-content-center justify-content-lg-end">
                    <ul class="pagination" id="pagination">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <button type="button"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="page-link focus-ring focus-ring-light"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"
                                    style="color: seagreen">&lsaquo;</button>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span
                                        class="page-link">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active"
                                            wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                            aria-current="page"><span class="page-link"
                                                style="background-color: seagreen; border-color: seagreen">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item text-success"
                                            wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                            <button type="button" class="page-link focus-ring focus-ring-light"
                                                style="color: seagreen"
                                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <button type="button"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="page-link focus-ring focus-ring-light"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')"
                                    style="color: seagreen">&rsaquo;</button>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @elseif($paginator->total() == 0)
    @else
        <nav class="mt-2 mb-2 mx-4">
            <div class="row">
                <div class="col-xl-3 align-self-center text-center text-lg-start">
                    <p>
                        <span>{!! __('Menampilkan') !!}</span>
                        <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                        <span>{!! __('ke') !!}</span>
                        <span class="fw-bold">{{ $paginator->lastItem() }}</span>
                        <span>{!! __('dari') !!}</span>
                        <span class="fw-bold">{{ $paginator->total() }}</span>
                        <span>{!! __('hasil') !!}</span>
                    </p>
                </div>
            </div>
        </nav>
    @endif
</div>
