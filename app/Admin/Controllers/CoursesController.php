<?php

namespace App\Admin\Controllers;

use App\Models\Categories;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Courses;
use App\Models\User;

class CoursesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Courses';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Courses());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));

        // Display user name or return 'Unknown' if null
        $grid->column('user_id', __('Instructor'))->display(function ($userId) {
            $user = User::find($userId);
            return $user ? $user->name : 'Unknown'; // Check if user exists
        });

        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('price', __('Price'));

        // Display category name or return 'Unknown' if null
        $grid->column('categories_id', __('Category'))->display(function ($categoryId) {
            $category = Categories::find($categoryId);
            return $category ? $category->name : 'Unknown'; // Check if category exists
        });

        $grid->column('language', __('Language'));
        $grid->column('thumbnail', __('Thumbnail'));
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
        $show = new Show(Courses::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));

        // Display user name or return 'Unknown' if null
        $show->field('user_id', __('Instructor'))->as(function ($userId) {
            $user = User::find($userId);
            return $user ? $user->name : 'Unknown'; // Check if user exists
        });

        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));

        // Display category name or return 'Unknown' if null
        $show->field('categories_id', __('Category'))->as(function ($categoryId) {
            $category = Categories::find($categoryId);
            return $category ? $category->name : 'Unknown'; // Check if category exists
        });

        $show->field('language', __('Language'));
        $show->field('thumbnail', __('Thumbnail'));
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
        $form = new Form(new Courses());

        // Select field for the instructor, showing the name but storing the id
        $form->text('name', __('Name'));
        $form->select('user_id', __('Instructor'))
             ->options(User::where('role_id', 2)->pluck('name', 'id')) // Fetch users with role_id 2
             ->required();

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'));

        // Dropdown for selecting specific categories (modify the condition as needed)
        $form->select('categories_id', __('Category'))
             ->options(Categories::all()->pluck('name', 'id')) // Populate dropdown with category names
             ->required();

        $form->text('language', __('Language'));
        $form->file('thumbnail', __('Thumbnail'));

        return $form;
    }
}
