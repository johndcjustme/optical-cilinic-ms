<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Category;

use App\Traits\WithSorting;
use App\Traits\Modal;
use App\Traits\SharedVariables;
use App\Traits\UserActivities;

class PageInventoryCategory extends Component
{
    use WithPagination;
    use WithSorting;
    use Modal;
    use SharedVariables;
    use UserActivities;

    protected $listeners = [
        'deleted_multiple'
    ];

    public $cat = [
        'id' => '',
        'title' => '',
        'description' => '',
        'color' => '',
        'bgcolor' => '',
        'hex' => '',
    ];

    public $delete = [
        'subject' => '',
        'category' => false,
        'categories' => false,
    ];

    private $CATEGORY;

    public function mount()
    {
        $this->orderBy = 'id';
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.pages.page-inventory-category', [
            'categories' => Category::where('title', 'like', $search)
                                ->orderBy($this->orderBy, $this->sortDirection)
                                ->simplePaginate(100),
        ]);
    }

    public function setCategory()
    {
        return [
            'title'         => $this->cat['title'],
            'description'   => $this->cat['description'] ?? null,
            'color'         => $this->cat['color'] ?? null,
            'bgcolor'       => $this->cat['bgcolor'] ?? null,
            'hex'           => $this->cat['hex'] ?? null,
        ];
    }

    public function create_or_update() 
    {
        if ($this->hasPermission('category-manage'))
            return;

        $this->validateFirst();
        empty($this->cat['id'])
            ? $this->create()
            : $this->update();
    }

    public function create()
    {
        try {
            Category::create($this->setCategory());

            $this->trait_user_activity_category_create();

            $this->modal('close');
            $this->reset(['cat']);
            $this->resetValidation();
            $this->toast('success', 'New category has been added successfully.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function update()
    {
        try {
            Category::findOrFail($this->cat['id'])->update($this->setCategory());

            $this->trait_user_activity_category_update();

            $this->modal('close');
            $this->reset(['cat']);
            $this->resetValidation();
            $this->toast('success', 'Category has been updated successfully.');
        } catch (\Exception $wtf) { $this->toastError(); }
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        $this->cat['id'] = $category->id;
        $this->cat['title'] = $category->title;
        $this->cat['description'] = $category->description;
        $this->cat['color'] = $category->color;
        $this->cat['bgcolor'] = $category->bgcolor;

        $this->modal('show');
    }


    // public function delete($id = null, $subject = null) 
    // {
    //     $this->delete['subject'] = $subject;
    //     if (is_null($id)) {
    //         $this->delete['categories'] = true;
    //         $this->confirmation('show', 'Delete Category', 'Are you sure you want to delete selected categories?');
    //     } else {
    //         $this->cat['id'] = $id;
    //         $this->delete['category'] = true;
    //         $this->confirmation('show', 'Delete Category', 'Are you sure you want to delete "' . $subject . '"?');
    //     }
    // }

    // public function deleted()
    // {
    //     $category = Category::destroy($this->cat['id']);
    //     $this->confirmation('close');
    //     $this->toast('success', '"' . $this->delete['subject'] . '" has been deleted successfully.');
    //     $this->reset(['cat', 'delete']);
    // }

    public function deleting_categories()
    {
        return $this->confirmDialog('deleted_multiple', 'Are you sure you want to delete selected Category?');
    }

    public function deleted_multiple()
    {
        if ($this->hasPermission('category-manage'))
            return;

        Category::destroy($this->selected_items);

        $this->trait_user_activity_category_delete(count($this->selected_items));

        $this->confirmation('close');
        $this->toast('success', 'Selected categories has been deleted successfully.');
        $this->reset(['cat', 'delete', 'selected_items']);
    }

    // public function confirm()
    // {
    //     ! $this->delete['category'] 
    //         ?: $this->deleted();
    //     ! $this->delete['categories'] 
    //         ?: $this->deleted_multiple();
    // }




    public function set_indicator($color, $bgcolor, $hex)
    {
        $this->cat['color'] = $color;
        $this->cat['bgcolor'] = $bgcolor;
        $this->cat['hex'] = $hex;
    }

    public function modal_show()
    {
        $this->reset(['cat']);
        $this->resetValidation();
        $this->modal('show');
    }

    private function validateFirst()
    {
        $this->validate([
            'cat.title' => 'required|max:100|min:2',
            'cat.description' => 'string|nullable',
        ], [
            'cat.title.required' => 'Required field',
            'cat.title.max' => 'Maximum of 100 chars',
            'cat.title.min' => 'At least 2 chars',
        ]);
    }
}
