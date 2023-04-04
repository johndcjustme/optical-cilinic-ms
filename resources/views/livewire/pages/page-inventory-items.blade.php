<div>
    @include('livewire.pages.includes.options-inventory-index')


    <x-layouts.main-content-content>
        <x-layouts.filter/>
        <x-organisms.table-index :paginate="$items" with-card>
            <x-slot name="header">
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        @php
                            $active = $displayed_category == 'all' ? 'active' : '';
                        @endphp
                        <a class="nav-link {{ $active }}"
                            wire:click.prevent="$set('displayed_category', 'all')" 
                            href="#">All</a>
                    </li>
                    @foreach ($categories as $cat)
                        @php
                            $active = $displayed_category == $cat->id ? 'active' : '';
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $active }}" 
                                wire:click.prevent="displayed_category({{ $cat->id }}, '{{ $cat->title }}')" 
                                href="#">{{ $cat->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </x-slot>
            <x-slot name="thead">
                <x-organisms.table-th-checkbox/>
                <x-organisms.table-th 
                    text="#" 
                    style="width: 2em;"/>
                <x-organisms.table-th/>
                <x-organisms.table-th 
                    style="width:8em"
                    text="Category" 
                    sort-column="category_id"
                    :direction="$orderBy === 'category_id' ? $sortDirection : null"/>
                <x-organisms.table-th 
                    text="Name" 
                    sort-column="name" 
                    :direction="$orderBy === 'name' ? $sortDirection : null"/>
                <x-organisms.table-th 
                    text="Size"/>
                <x-organisms.table-th 
                    text="Supplier" 
                    sort-column="supplier_id" 
                    :direction="$orderBy === 'supplier_id' ? $sortDirection : null"/>
                <x-organisms.table-th 
                    style="width: 2em;"/> 
                <x-organisms.table-th 
                    text="On Hand" 
                    sort-column="quantity" 
                    :direction="$orderBy === 'quantity' ? $sortDirection : null"/>
                <x-organisms.table-th 
                    text="Unit"/>
                <x-organisms.table-th 
                    text="Price" 
                    sort-column="price" 
                    :direction="$orderBy === 'price' ? $sortDirection : null"/>
                <x-organisms.table-th-action/>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($items as $key => $item)
                    <tr>
                        <x-organisms.table-td-checkbox
                            :value="$item->id"
                            w-model="selected_items"/>
                        <x-organisms.table-td 
                            :desc="$items->firstItem() + $key"/>
                        <x-organisms.table-td 
                            :text="$this->has_reorder($item->id)" 
                            icon="bi-cart-check-fill"
                            text-class="text-success"/>
                        <x-organisms.table-td>
                            <span class="badge font-sm rounded-pill text-{{ $item->category->color }} bg-{{ $item->category->bgcolor }}" style="font-weight: normal; font-size:0.65rem;">{{ $item->category->title }}</span>
                        </x-organisms.table-td>
                        <x-organisms.table-th
                            scope="row"
                            :text="Str::limit($item->name, 40)"
                            :desc="Str::limit($item->description, 40)"
                            :desc-title="$item->description"/>
                        <x-organisms.table-td
                            :text="$item->size"
                            :desc="$item->sphere"/>
                        <x-organisms.table-td
                            :text="$item->supplier->name"
                            :desc="empty($item->supplier->branch) ? '' : 'Br: ' . $item->supplier->branch"/>
                        <x-organisms.table-td wire:ignore wire:key="{{ $item->id }}">
                            <div class="dropdown" title="In item">
                                <button class="btn btn-light btn-sm" style="font-size: 1em;" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                                <ul class="dropdown-menu shadow px-3 pb-3">
                                    <label class="mb-1 text-muted">In item</label>
                                    <form wire:submit.prevent="in_item({{ $item->id }}, '{{ $item->name }}')" class="input-group">
                                        <input wire:model.defer="item_in" type="number" min="1" class="form-control form-control-sm @error('item_in') is-invalid @enderror" placeholder="Quantity..." required>
                                        <button {!! $this->confirm_in_item($item->name) !!} class="btn btn-sm btn-primary" type="submit">OK</button>
                                    </form>
                                </ul>
                            </div>
                        </x-organisms.table-td>
                        <x-organisms.table-td
                            :text="$item->quantity == 0 ? '--' : $item->quantity"
                            :desc="$item->buffer"
                            text-class="{{ $item->quantity > $item->buffer ?: 'text-danger'; }} font-bold"
                            desc-icon="graph-down-arrow opacity-50"/>
                        <x-organisms.table-td
                            :text="$item->unit"/>
                        @if (Auth::user()->hasPermission('item-cost-edit'))
                            <x-organisms.table-td
                                icon="bi-tag-fill"
                                :text="number_format($item->price, 2)"
                                :desc="'Cost: ' . number_format($item->cost, 2)"/>
                        @else 
                            <x-organisms.table-td
                                icon="bi-tag-fill"
                                :text="number_format($item->price, 2)"/>
                        @endif
                        <x-organisms.table-td-action
                            edit="$emit('edit', {{ $item->id }})"
                            more>
                                <x-molecules.dropdown-item w-click="duplicate({{ $item->id }})" icon="bi-subtract" text="Duplicate"/>
                                <li><hr class="dropdown-divider"></li>
                                <div class="py-2 px-3">
                                    <label class="mb-1 text-muted">Re-order</label>
                                    <form wire:submit.prevent="reorder('{{ $item->id }}', '{{ $item->name }}')" class="input-group">
                                        <input wire:model.defer="reorder_quantity" min="1" type="number" class="form-control form-control-sm" placeholder="Quantity..." required>
                                        <x-atoms.button type="submit" text="OK" class="btn btn-primary btn-sm"/>
                                    </form>
                                </div>
                        </x-organisms.table-td-action>
                    </tr>
                @empty 
                    <x-organisms.table-td colspan="10" class="text-center" text="Not data found."/> 
                @endforelse
            </x-slot>
        </x-organisms.table-index>
    </x-layouts.main-content-content>

    <x-organisms.confirm-dialog/>
</div>    


