<div class="box box-primary">
    <div class="box-body">
        <table class="table dataTable table-striped table-bordered">
            <colgroup>
            @foreach($columns as $key => $col)
                <col class="col {{ $key }}" width="{{ array_get($col, 'width')}}"  />
            @endforeach
            </colgroup>
            <thead>
                <tr>
                @foreach($columns as $key => $col)
                    <th class="head {{ $key }}">
                        {{ $col['th'] }}
                    </th>
                @endforeach
                </tr>
            </thead>

            @if(array_get($tableOptions, 'tfoot', false) === true)
            <tfoot>
                <tr class="info">
                @foreach($columns as $key => $col)
                    <td class="foot {{ $key }}">&nbsp;</td>
                @endforeach
                </tr>
            </tfoot>
            @endif

            <tbody>
                @foreach($data as $row)
                <tr>
                    @foreach($row as $cell)
                    <td>{{ $cell }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

tableOptions = {
    @foreach ($options as $k => $o) {{ json_encode($k) }}: {{ json_encode($o) }},
    @endforeach
    @foreach ($callbacks as $k => $o) {{ json_encode($k) }}: {{ $o }},
    @endforeach

    "bStateSave": true,
    "bFilter": {{ (array_get($tableOptions, 'filtering', false) === true ? 'true' : 'false') }},
    "bSort": {{ (array_get($tableOptions, 'sorting', false) === true ? 'true' : 'false') }},
    "bPaginate": {{ (array_get($tableOptions, 'pagination', false) === true ? 'true' : 'false') }},
    "bAutoWidth": false,
    "fnDrawCallback": function (oSettings) {
        if (window.onDatatableReady) {
            window.onDatatableReady();
        }
    }
};

jQuery(window).load(function () {
    jQuery('table.dataTable').dataTable(tableOptions);
});
</script>
