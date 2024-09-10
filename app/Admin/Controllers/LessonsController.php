<?php

namespace App\Admin\Controllers;

use App\Models\Courses;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Lessons;

class LessonsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lessons';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lessons());

        $grid->column('id', __('Id'));
        $grid->column('course_id', __('Course'))->display(function ($courseId) {
            return Courses::find($courseId)->name;
        });
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('duration', __('Duration'));
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
        $show = new Show(Lessons::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('course_id', __('Course'))->as(function ($courseId) {
            return Courses::find($courseId)->name;
        });
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('duration', __('Duration'));
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
        $form = new Form(new Lessons());

        $form->select('course_id', __('Course'))
            ->options(Courses::all()->pluck('name', 'id')) // Modify this condition based on your needs
            ->required();
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->number('duration', __('Duration'));

        return $form;
    }
}
