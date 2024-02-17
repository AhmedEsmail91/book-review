<div class="">
    @if ($rating)
        @for ($i = 1; $i <= 5; $i++)
            {{-- {{ $i <= round($rating) ? '★' : '☆' }} --}}
            @if (ceil($rating)>=$i)
                ★
            @else

            @endif
        @endfor
    @else
    No rating yet
    @endif
</div>