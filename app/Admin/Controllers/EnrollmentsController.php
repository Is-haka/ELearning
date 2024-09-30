<?php

namespace App\Admin\Controllers;

use App\Models\Courses;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Enrollments;
use App\Models\User;

class EnrollmentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Enrollments';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Enrollments());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User'))->display(function ($userId) {
            return User::find($userId)->name; // Display user name instead of ID
        });
        $grid->column('course_id', __('Course'))->display(function ($courseId) {
            return Courses::find($courseId)->name;
        });        $grid->column('status', __('Status'));
        $grid->column('duration', __('duration'));
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
        $show = new Show(Enrollments::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User'))->as(function ($userId) {
            return User::find($userId)->name;
        });
        $show->field('course_id', __('Course'))->as(function ($courseId) {
            return Courses::find($courseId)->name;
        });        $show->field('status', __('Status'));
        $show->field('duration', __('duration'));
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
        $form = new Form(new Enrollments());
        $form->select('user_id', __('User'))->options(User::where('role_id', 3)->pluck('name', 'id'))->required();
        $form->select('course_id', __('Course'))->options(Courses::all()->pluck('name', 'id'))->required();
        $form->text('status', __('Status'))->default('not enrolled');

        return $form;
    }
}
