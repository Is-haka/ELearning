<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use Illuminate\Support\HtmlString;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\LessonType;
use \App\Models\Lesson;
use App\Models\Lessons;

class LessonTypeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Type of lesson content';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
{
    $grid = new Grid(new LessonType());

    $grid->column('id', __('Id'));
    $grid->column('reading', __('Reading'))->display(function ($file) {
        return $file ? new HtmlString("<a href='/uploads/{$file}' target='_blank'>View Article</a>") : 'No file';
    }); // Display as clickable link for reading file
    $grid->column('video', __('Video'))->display(function ($file) {
        return $file ? new HtmlString("<a href='/uploads/videos/{$file}' target='_blank'>View Video</a>") : 'No file';
    }); // Display as clickable link for video file
    $grid->column('lesson_id', __('Lesson'))->display(function ($lessonId) {
        $lesson = Lessons::find($lessonId);
        return $lesson ? $lesson->title : 'Unknown'; // Show lesson name instead of id
    });
    $grid->column('created_at', __('Created at'));
    $grid->column('updated_at', __('Updated at'));

    return $grid;
}

protected function detail($id)
{
    $show = new Show(LessonType::findOrFail($id));

    $show->field('id', __('Id'));
    $show->field('reading', __('Reading'))->as(function ($file) {
        return $file ? new HtmlString("<a href='/uploads/{$file}' target='_blank'>View Article</a>") : 'No file';
    }); // Display as clickable link for reading file
    $show->field('video', __('Video'))->as(function ($file) {
        return $file ? new HtmlString("<a href='/uploads/{$file}' target='_blank'>View Video</a>") : 'No file';
    }); // Display as clickable link for video file
    $show->field('lesson_id', __('Lesson'))->as(function ($lessonId) {
        $lesson = Lessons::find($lessonId);
        return $lesson ? $lesson->title : 'Unknown'; // Show lesson name instead of id
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
        $form = new Form(new LessonType());

        // Upload field for reading (assuming it's an article file, e.g., PDF, DOCX)
        $form->file('reading', __('Upload Article'))->move('articles'); // Moves the file to the 'articles' directory

        // Upload field for video (e.g., MP4)
        $form->file('video', __('Upload Video'))->move('videos'); // Moves the file to the 'videos' directory

        // Dropdown for selecting the lesson name instead of lesson ID
        $form->select('lesson_id', __('Lesson'))->options(Lessons::all()->pluck('title', 'id'))->required(); // Populates the dropdown with lesson names

        return $form;
    }
}
