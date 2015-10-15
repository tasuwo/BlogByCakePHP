<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Posts Tag'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="postsTags index large-9 medium-8 columns content">
    <h3><?= __('Posts Tags') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('post_id') ?></th>
                <th><?= $this->Paginator->sort('tag_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postsTags as $postsTag): ?>
            <tr>
                <td><?= $postsTag->has('post') ? $this->Html->link($postsTag->post->title, ['controller' => 'Posts', 'action' => 'view', $postsTag->post->id]) : '' ?></td>
                <td><?= $postsTag->has('tag') ? $this->Html->link($postsTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $postsTag->tag->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $postsTag->post_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $postsTag->post_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $postsTag->post_id], ['confirm' => __('Are you sure you want to delete # {0}?', $postsTag->post_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
