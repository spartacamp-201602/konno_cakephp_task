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

<?php foreach ($tasks as $task) : ?>
    <?php echo $this->element('task', array('task' => $task)); ?>
<?php endforeach; ?>