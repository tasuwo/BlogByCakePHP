<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('dashboard.css') ?>
    <link
        href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
        rel="stylesheet">
</head>
<body class="home">

<?= $this->element('header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active">
                    <a href="#">Active<span class="sr-only">(current)</span></a>
                </li>
                <li><a href="#">Non-Active</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <table cellpadding="0" cellspacing="0">
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <div class="well">
                            <h3><a href=""><?= h($post->title) ?></a></h3>
                            <hr>
                            <p><i class="fa fa-calendar"></i>
                                <?= h($post->created_at) ?>
                            </p>

                            <p><i class="fa fa-tags"></i>
                                Tags: <a href="">
                                    <span class="badge badge-info">
                                        Bootstrap
                                    </span>
                                </a>
                                <a href="">
                                    <span class="badge badge-info">
                                        Web
                                    </span>
                                </a>
                                <a href="">
                                    <span class="badge badge-info">
                                        CSS
                                    </span>
                                </a>
                                <a href="">
                                    <span class="badge badge-info">
                                        HTML
                                    </span>
                                </a>
                            </p>
                            <hr>
                            <p class="lead"><?= h($post->body) ?></p>
                            <?= $this->Html->link(
                                'Read on →',
                                [
                                    'action' => 'view',
                                    $post->id
                                ],
                                [
                                    'class' => "btn btn-default btn-primary"
                                ]
                            ) ?>
                            <?php if ($this->request->session()->read(
                                'Auth.User'
                            )
                            ): ?>
                                <hr>
                                <?= $this->Html->link(
                                    __('Edit'),
                                    [
                                        'action' => 'edit',
                                        $post->id
                                    ],
                                    [
                                        'class' => "btn btn-default btn-success"
                                    ]
                                ) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    [
                                        'action' => 'delete',
                                        $post->id
                                    ],
                                    [
                                        'confirm' => __(
                                            'Are you sure you want to delete # {0}?',
                                            $post->id
                                        ),
                                        'class' => "btn btn-default btn-danger"
                                    ]
                                ) ?>
                            <?php endif; ?>
                        </div>
                    </tr>
                <?php endforeach; ?>
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
    </div>
</div>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
