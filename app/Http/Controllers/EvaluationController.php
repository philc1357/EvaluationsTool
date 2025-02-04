<?php

namespace App\Http\Controllers;

use App\Repositories\EvaluationRepository;
use Illuminate\Http\Request;

class EvaluationController extends DataTableController
{
    protected $view ='evaluation';
    protected $filterColumns =['limit','offset'];
    protected $repository;

    public function __construct(EvaluationRepository $repository) {
        $this->repository = $repository;
    }

    protected function get_questions(Request $request, $id) {
        return $this->repository->get_questions($request->all(), $id);
    }

    protected function preview_sheet($id) {
        return $this->repository->preview_sheet($id);
    }

    protected function get_questionname(Request $request) {
        return $this->repository->get_questionname($request);
    }

    protected function get_sheets(Request $request) {
        return $this->repository->get_sheets($request->all());
    }

    protected function get_sheet($id) {
        return $this->repository->get_sheet($id);
    }

    protected function get_sheetname(Request $request) {
        return $this->repository->get_sheetname($request);
    }

    protected function post_sheet(Request $request) {
        return $this->repository->post_sheet($request->all());
    }

    protected function post_question(Request $request) {
        return $this->repository->post_question($request->all());
    }

    protected function delete_question(Request $request) {
        return $this->repository->delete_question($request->all());
    }

    protected function delete_sheet(Request $request) {
        return $this->repository->delete_sheet($request->all());
    }

    protected function update_question(Request $request) {
        return $this->repository->update_question($request->all());
    }

    protected function update_sheet(Request $request) {
        return $this->repository->update_sheet($request->all());
    }

    protected function save_response(Request $request) {
        return $this->repository->save_response($request->all());
    }

    protected function save_evaluation(Request $request) {
        return $this->repository->save_evaluation($request->all());
    }
}

