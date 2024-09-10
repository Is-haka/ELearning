<?php

namespace App\Admin\Controllers;

use App\Models\Categories;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Instructor;
use \App\Models\User; // Import User model
use \App\Models\Category; // Import Category model

class InstructorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Instructor';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Instructor());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('Instructor'))->display(function ($userId) {
            return User::find($userId)->name; // Display user name instead of ID
        });
        $grid->column('categories_id', __('Category'))->display(function ($categoryId) {
            return Categories::find($categoryId)->name; // Display category name instead of ID
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Instructor::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('Instructor'))->as(function ($userId) {
            return User::find($userId)->name; // Display user name instead of ID
        });
        $show->field('categories_id', __('Category'))->as(function ($categoryId) {
            return Categories::find($categoryId)->name; // Display category name instead of ID
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Instructor());

        // Dropdown for selecting a user with role_id = 2 (instructors)
        $form->select('user_id', __('Instructor'))
             ->options(User::where('role_id', 2)->pluck('name', 'id')) // Fetch users with role_id 2
             ->required();

        // Dropdown for selecting specific categories (modify the condition as needed)
        $form->select('categories_id', __('Category'))
             ->options(Categories::all()->pluck('name', 'id')) // Modify this condition based on your needs
             ->required();

        return $form;
    }
}
