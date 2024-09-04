@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center" style="background-color: #ffffff;">
            {{-- 前のページリンク --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link"
                          aria-hidden="true"
                          style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                               border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                               background-color: #ffffff;">
                        Previous
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       aria-label="@lang('pagination.previous')"
                       style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                              border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                              background-color: #ffffff;">
                        Previous
                    </a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                {{-- "..." セパレーター --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link"
                              style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                     border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                     background-color: #ffffff;">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- リンクの配列 --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link"
                                      style="background-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                             color: white;
                                             border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                   href="{{ $url }}"
                                   style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                          border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                          background-color: #ffffff;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページリンク --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       aria-label="@lang('pagination.next')"
                       style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                              border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                              background-color: #ffffff;">
                        Next
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link"
                          aria-hidden="true"
                          style="color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                 border-color: {{ request()->is('admin/*') ? '#007bff' : '#5a5' }};
                                 background-color: #ffffff;">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
