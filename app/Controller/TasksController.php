<?php
class TasksController extends AppController {

    public $helpers = array('Html');
    public $components = array('Flash');

    public function index() {
        $options = array(
            'conditions' => array(
                'Task.status' => 0
                )
            );

        $tasks = $this->Task->find('all', $options);

        $this->set('tasks', $tasks);
    }

    public function done($id) {

        // idをセット
        $this->Task->id = $id;

        if ($this->Task->saveField('status', 1)) {
            // 完了処理に成功した場合
            $msg = sprintf('タスク %s を完了しました。', $id);
            $this->Flash->success($msg);

            return $this->redirect(array('action' => 'index'));
        } else {
            // 失敗した場合
            $msg = sprintf('タスク %s を何らかの理由により完了できませんでした。', $id);
            $this->Flash->success($msg);
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function create() {
        if ($this->request->is('post')) {

            // タスクを保存
            $this->Task->save($this->request->data);

            // フラッシュメッセージ
            $msg = sprintf('タスク %s を追加しました。', $this->Task->id);
            $this->Flash->success($msg);

            return $this->redirect(array('action' => 'index'));
        }
    }
}