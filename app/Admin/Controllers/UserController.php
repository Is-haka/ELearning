<?php

namespace App\Admin\Controllers;

use App\Models\AdminRole;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;
use \App\Models\Role; // Import Role model

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('profile', __('Profile'))->image();

        // Show role name instead of role_id
        $grid->column('role_id', __('Role'))->display(function ($roleId) {
            return AdminRole::find($roleId)->name; // Fetch role name based on role_id
        });

        $grid->column('email_verified_at', __('Email verified at'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('profile', __('Profile'));

        // Show role name in detail view
        $show->field('role_id', __('Role'))->as(function ($roleId) {
            return AdminRole::find($roleId)->name;
        });

        $show->field('email_verified_at', __('Email verified at'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('username', __('Username'));
        $form->email('email', __('Email'));
        $form->file('profile', __('Profile'))->move('images'); // Upload field

        // Dropdown for roles
        $form->select('role_id', __('Role'))
             ->options(AdminRole::all()->pluck('name', 'id')) // Fetch roles for dropdown
             ->required();

        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));

        return $form;
    }
}
