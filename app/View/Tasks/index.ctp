<?php
// 新規タスク登録リンク生成
echo $this->Html->link(
    '新規タスクを追加',
    array(
        'controller' => 'tasks',
        'action' => 'create'
    )
);
?>

<h3><?= count($tasks) ?>件のタスクが未完了です</h3>

<!-- <?php debug($tasks) ?> -->

<table>
    <tr>
        <th>ID</th>
        <th>タスク</th>
        <th>期限</th>
        <th>作成日</th>
        <th>操作</th>
    </tr>
    <?php foreach ($tasks as $task) : ?>
    <tr>
        <td><?= $task['Task']['id'] ?></td>
        <td>
            <?= h($task['Task']['name']) ?>
            <!-- notesテーブルのbody表示を追加 -->
            <ul>
                <?php foreach ($task['Note'] as $note) : ?>
                    <li>
                        <?= $note['body'] ?>
                    </li>
                <?php endforeach ?>
                <?= $this->Html->link('コメントを追加', '/notes/add') ?>
            </ul>
        </td>
        <td><?= h($task['Task']['due_date']) ?></td>
        <td><?= h($task['Task']['created']) ?></td>
        <td>
            <?= $this->Html->link(
                '完了',
                    array(
                        'controller' => 'tasks',
                        'action' => 'done',
                        $task['Task']['id']
                        )
                    );
            ?>
        </td>
    </tr>
    <?php endforeach ?>
</table>