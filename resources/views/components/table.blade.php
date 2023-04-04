<table {{ $attributes->merge(['class' => 'table table-striped dt-responsive nowrap']) }} cellspacing="0" width="100%">
    @isset($thead)
        <thead>
            {{ $thead }}
        </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
        <tfoot>
            {{ $tfoot }}
        </tfoot>
    @endisset
</table>
