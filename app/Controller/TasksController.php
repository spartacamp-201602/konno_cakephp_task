<?php

class TasksController extends AppController {
    // public $scaffold;

    // HTML Helperを利用するための宣言
    public $helpers = array('Html', 'Form');

    // 使用するコンポーネントの記述
    public $components = array('Flash');

    public function index() {

        // 未完了のタスクを取得したい
        $options = array(
            'conditions' => array(
                'Task.status' => 0
                )
            );

        $tasks = $this->Task->find('all', $options);
        // 上のコードでどんなSQLが走る？
        // sql = 'select * from tasks';

        // Viewに運ぶためにアクションに tasks を set する
        $this->set('tasks', $tasks);
    }

    public function done($id) {

        // getによってきた場合は例外を発生
        // if ($this->request->is('get')) {
        //     throw new MethodNotAllowedException('MethodNotAllowedException: getによる実行は禁止されています');
        // }

       // 飛んできたidをセットする
        $this->Task->id = $id;

        // done処理を行う
        if ($this->Task->saveField('status', 1)) {

            // フラッシュメッセージとともにリダイレクト
            $msg = sprintf('タスク %s を完了しました。', $id);
            $this->Flash->success($msg);

            // タスク一覧indexへリダイレクト
            return $this->redirect(array('action' => 'index'));
        } else {
            // うまく完了できなかった場合

            $this->Flash->error('タスクを完了できませんでした。');
        }

    }

    public function create() {

        // POSTメソッドかチェック
        if ($this->request->is('post')) {

            // 送られてきたデータを保存
            if ($this->Task->save($this->request->data)) {
                // 保存に成功
                $msg = sprintf('タスク %s を作成しました', $this->Task->id);
                $this->Flash->success($msg);

                $this->redirect(array('action' => 'index'));

            } else {
                // 保存に失敗
                $msg = sprintf('タスク %s の作成に失敗しました', $id);
                $this->Flash->error($msg);
            }

        }

    }
}