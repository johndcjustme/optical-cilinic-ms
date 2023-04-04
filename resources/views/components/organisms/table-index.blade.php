@if ($withCard)
    <div class="card">
        <div class="card-body mt-4" style="overflow: auto;">
@endif
            {{ $header ?? null }}
            
            <div> <!-- make it responsive by adding a class="table-responsive" -->
                <table {{ $attributes->merge(['class' => 'table'])}}>
                    <thead class="border-bottom-4 border-dark">
                        <tr>
                            {{ $thead }}
                        </tr>
                    </thead>
                    <tbody>
                        {{ $tbody}}
                    </tbody>
                </table>
            </div>

            @if (!is_null($paginate))
                <div class="d-flex align-items-center gap-4">

                    {{ $paginate->links() }}
                        
                    @if (count($paginate) > 0)
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted">
                                Entries
                            </small>
                            <select wire:model="paginate" class="form-select">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                    @endif
                </div>
            @endif

@if ($withCard)
        </div>
    </div>
@endif