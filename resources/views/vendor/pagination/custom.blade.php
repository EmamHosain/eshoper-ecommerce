@if ($paginator->hasPages())
    <div class="col-12 pb-1">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-3">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        {{-- <span aria-hidden="true">&lsaquo;</span> --}}
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="@lang('pagination.previous')">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif



                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                {{-- active li --}}
                                <li class="active page-item" aria-current="page">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    {{-- <span>{{ $page }}</span> --}}
                                </li>
                            @else
                                <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach



                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="@lang('pagination.next')">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @else
                    <li class=" page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @endif


                {{-- first --}}
                {{-- <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li> --}}


                {{-- second --}}
                {{-- <li class="page-item active"><a class="page-link" href="#">1</a></li> --}}



                {{-- third --}}
                {{-- <li class="page-item"><a class="page-link" href="#">2</a></li> --}}





                {{-- fourth --}}
                {{-- <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li> --}}



            </ul>
        </nav>
    </div>
@endif
