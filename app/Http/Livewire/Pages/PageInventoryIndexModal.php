<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Item;

use App\Traits\Modal;
use App\Traits\UserActivities;


class PageInventoryIndexModal extends Component
{
    use Modal;
    use UserActivities;

    public
        $item = [
            'id' => '',
            'name' => '',
            'code',
            'price_code',
            'category_id',
            'supplier_id',
            'image',
            'description',
            'quantity',
            'size',
            'type',
            'unit',
            'price',
            'cost',
            'buffer',
            'sph',
            'cyl',
        ],
        $CATEGORY,
        $SUPPLIER;

    protected $listeners = ['modal_show', 'edit'];

    public function mount()
    {
        $this->CATEGORY = new Category;
        $this->SUPPLIER = new Supplier;
    }

    public function render()
    {
        return view('livewire.pages.page-inventory-index-modal', [
            'categories' => $this->CATEGORY->all(),
            'suppliers' => $this->SUPPLIER->all(['id', 'name', 'branch']),
        ]);
    }


    public function validate_first()
    {   
        $this->validate([
            'item.name' => 'required|min:2|max:200',
            'item.description' => 'nullable|max:255|min:2',
            'item.price' => 'nullable|regex:/^\d*(\.\d{2})?$/',
            'item.cost' => 'nullable|regex:/^\d*(\.\d{2})?$/',
            'item.buffer' => 'nullable|integer|min:0',
            'item.quantity' => 'nullable|integer|min:0',
            'item.category_id' => 'required',
        ], [
            'item.name.required' => 'Required field',
            'item.name.min' => 'At least 2 chars',
            'item.name.max' => 'Maximum of 200 chars',

            'item.description.max' => 'Maximum of 255 chars',
            'item.description.min' => 'At least 2 chars',

            'item.price.regex' => 'Invalid format',
            'item.price.cost' => 'Invalid format',

            'item.buffer.integer' => 'Invalid format',
            'item.buffer.min' => 'Invalid format',

            'item.quantity.integer' => 'Invalid format',
            'item.quantity.min' => 'Invalid format',

            'item.category_id.required' => 'Required field',
        ]);
    }


    public function create_or_update()
    {
        if ($this->hasPermission('item-manage')) 
            return;

        $this->validate_first();
        empty($this->item['id'])
            ? $this->create()
            : $this->update();
    }

    public function create()
    {
        try {
            $item = Item::create($this->setItem());

            $this->trait_user_activity_item_create();

            $this->modal('close');
            $this->reset(['item']);
            $this->resetValidation();
            $this->toast('success', 'Item has been added successfully.');
        } catch(\Exception $wtf) { $this->toastError(); }
        $this->emit('refreshInventoryIndex');
    }

    public function update()
    {
        try {
            $item = Item::findOrFail($this->item['id'])->update($this->setItem());

            $this->trait_user_activity_item_update();

            $this->modal('close');
            $this->reset(['item']);
            $this->resetValidation();
            $this->toast('success', 'Item has been updated successfully.');
        } catch(\Exception $wtf) { $this->toastError(); }
        $this->emit('refreshInventoryIndex');
    }

    public function edit($id)
    {
        $this->item['id'] = $id;
        $item = Item::findOrFail($this->item['id']);

        $this->item['id']           = $item->id;
        $this->item['code']         = $item->code;
        $this->item['price_code']   = $item->price_code;
        $this->item['category_id']  = $item->category_id;
        $this->item['supplier_id']  = $item->supplier_id;
        $this->item['image']        = $item->image;
        $this->item['name']         = $item->name;
        $this->item['description']  = $item->description;
        $this->item['quantity']     = $item->quantity;
        $this->item['size']         = $item->size;
        $this->item['type']         = $item->type;
        $this->item['unit']         = $item->unit;
        $this->item['price']        = $item->price;
        $this->item['cost']         = $item->cost;
        $this->item['buffer']       = $item->buffer;
        $this->item['sph']          = $item->sph;
        $this->item['cyl']          = $item->cyl;

        $this->resetValidation();
        $this->modal('show');
    }



    public function setItem()
    {
        return [
            'id'            => $this->item['id'],
            'name'          => $this->item['name'],
            'code'          => $this->item['code'] ?? null,
            'price_code'    => $this->item['price_code'] ?? null,
            'category_id'   => empty($this->item['category_id']) ? null : $this->item['category_id'],
            'supplier_id'   => empty($this->item['supplier_id']) ? null : $this->item['supplier_id'],
            'quantity'      => empty($this->item['quantity']) ? 0 : $this->item['quantity'],
            'size'          => empty($this->item['size']) ? 0 : $this->item['size'],
            'price'         => empty($this->item['price']) ? 0 : $this->item['price'],
            'buffer'        => empty($this->item['buffer']) ? 0 : $this->item['buffer'],
            'cost'          => empty($this->item['cost']) ? 0 : $this->item['cost'],
            'image'         => $this->item['image'] ?? null,
            'description'   => $this->item['description'] ?? null,
            'type'          => $this->item['type'] ?? null,
            'unit'          => $this->item['unit'] ?? null,
            'sph'           => $this->item['sph'] ?? null,
            'cyl'           => $this->item['cyl'] ?? null,
        ];
    }

    public function modal_show()
    {
        $this->reset(['item']);
        $this->resetValidation();
        $this->modal('show');
    }
}