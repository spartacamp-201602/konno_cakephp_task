<!-- CSSの読み込み処理 -->
<?= $this->Html->css('task') ?>

<div class="roundBox">
    <h3>
        <?php echo h($task['Task']['id']); ?> :
        <?php echo h($task['Task']['name']); ?>
    </h3>
    <p>作成日 : <?php echo h($task['Task']['created']); ?></p>
    <p>期限 : <?php echo h($task['Task']['due_date']); ?></p>
    <p class="comment">
        <ul>
            <?php foreach ($task['Note'] as $note) : ?>
                <li><?php echo h($note['body']) ?></li>
            <?php endforeach; ?>
            <li>
                <?php echo $this->Html->link('コメントを追加', '/Notes/create'); ?>
            </li>
        </ul>
    </p>

    <?= $this->Html->link(
        '編集する',
        '/tasks/edit/' . $task['Task']['id'],
        array('class' => 'button left')) ?>

    <?= $this->Html->link(
        'このタスクを完了する',
        '/Tasks/done/' . $task['Task']['id'],
        array('class' => 'button right')) ?>
    </div>
