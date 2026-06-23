            <div class="container-xxl flex-grow-1 container-p-y">

                <div class="card data-tables-list">
                    <div class="d-flex justify-content-end mb-3 add-menu">

                        <a href="{{ route('add_door') }}" class=" btn rounded-pill btn-primary">
                            <span class="icon-base bx bx-pie-chart-alt icon-sm me-2"></span>
                            Add Door
                        </a>
                    </div>
                    {{ $dataTable->table() }}
                    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

                </div>
            </div>
