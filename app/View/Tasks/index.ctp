<h2>未完了タスク一覧</h2>

<!-- '/Tasks/create'へのリンクを作る -->
<?php

echo $this->html->link(
    '新規タスクを追加',
    array(
        'controller' => 'tasks',
        'action' => 'create'
    )
);

?>

<h3><?= count($tasks) ?>件のタスクが未完了です</h3>

<table>
    <tr>
        <th>ID</th>
        <th>タスク名</th>
        <th>期限名</th>
        <th>作成日</th>
        <th>操作</th>
    </tr>
    <?php foreach($tasks as $task): ?>
    <tr>
        <td><?= $this->Html->link($task['Task']['id'], '/Task/View/' . $task['Task']['id']); ?></td>
        <td><?= h($task['Task']['name']) ?></td>
        <td><?= h($task['Task']['due_date']) ?></td>
        <td><?= h($task['Task']['created']) ?></td>
        <td>
            <?= $this->html->link(
                '完了',
                array(
                    'controller' => 'tasks',
                    'action' => 'done',
                     $task['Task']['id']
                     )
                ); ?>
        </td>
    </tr>
    <?php endforeach ?>
</table>