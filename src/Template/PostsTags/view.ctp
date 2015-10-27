<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Posts Tag'), ['action' => 'edit', $postsTag->post_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Posts Tag'), ['action' => 'delete', $postsTag->post_id], ['confirm' => __('Are you sure you want to delete # {0}?', $postsTag->post_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Posts Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Posts Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="postsTags view large-9 medium-8 columns content">
    <h3><?= h($postsTag->post_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Post') ?></th>
            <td><?= $postsTag->has('post') ? $this->Html->link($postsTag->post->title, ['controller' => 'Posts', 'action' => 'view', $postsTag->post->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tag') ?></th>
            <td><?= $postsTag->has('tag') ? $this->Html->link($postsTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $postsTag->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($postsTag->id) ?></td>
        </tr>
    </table>
</div>
