@php($link_limit = env('PAGINATION_LINK_LIMIT', 12))
    
<center>
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="javascript:void(0);">&laquo;</a>
                </li>
                <li class="disabled">
                    <a href="javascript:void(0);">
                        <i class="material-icons">chevron_left</i>
                    </a>       
                </li>
            @else
                <li class="waves-effect">
                    <a href="{{ $paginator->url(1) }}">&laquo;</a>
                </li>
                <li class="waves-effect">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @endif
            
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                   $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                
            </li>

            @if ($paginator->hasMorePages())
                <li class="waves-effect">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
                <li class="waves-effect">
                    <a href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
                </li>    
            @else
                <li class="disabled">
                    <a href="javascript:void(0);">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
                <li class="disabled">
                    <a href="javascript:void(0);">&raquo;</a>
                </li>
            @endif
        </ul>
    @endif
</center>