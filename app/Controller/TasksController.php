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

            // タスクを保存試行
            if ($this->Task->save($this->request->data)) {
                $msg = sprintf('タスク %s を追加しました。', $this->Task->id);
                $this->Flash->success($msg);

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error('保存できませんでした。');
            }
        }
    }

    public function edit($id) {

        // 既存のタスクレコードを取得する
        $task = $this->Task->findById($id);

        if(!$task) {
            throw new NotFoundException('指定された記事は存在しません。');
        }

        // フォームからの送信をチェックする
        if ($this->request->is(array('post', 'put'))) {

            // 更新を試みる
            $this->Task->id = $id;

            if ($this->Task->save($this->request->data)) {
                $msg = sprintf('タスク %s 更新しました。', $id);
                $this->Flash->success($msg);
                return $this->redirect(array('action' => 'index'));
            } else {
                // 更新に失敗した場合
                $this->Flash->error('タスクを更新できませんでした。');
            }
        }

        // データが送られてきていない => 編集をする前のアクセス
        // 既存のレコードの内容をフォームに表示する
        if (!$this->request->data) {
            $this->request->data = $task;
        }
    }
}