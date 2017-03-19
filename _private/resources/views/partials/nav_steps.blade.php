<nav>
    <ul class="wrap">
        @for($i = 1; $i <=5; $i++)
        <li><span {!! is_active($step, $i) !!} class="{{ \App\Models\Settings::NAV_STEPS[$i] }}" aria-hidden="true"></span></li>
        @endfor
    </ul>
</nav>