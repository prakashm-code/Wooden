<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">

        <div class="card-header">
            <h4>Order Report</h4>
        </div>

        <div class="card-body">

            {{ $dataTable->table() }}

        </div>

    </div>

</div>

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
