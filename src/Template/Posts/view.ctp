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


            <div class="well">
                <h3><a href=""><?= h($post->title) ?></a></h3>
                <hr>
                <p><i class="fa fa-calendar"></i>
                    <?= h($post->created_at) ?>
                </p>

                <p><i class="fa fa-tags"></i>
                    Tags:
                    <?php
                    if (!empty($post->tags)) {
                        foreach ($post->tags as $tags) {
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    $tags->name,
                                    ['class' => "badge badge-info"]
                                ),
                                [
                                    'action' => 'index',
                                    '?' => ['tag' => $tags->name]
                                ],
                                ['escape' => false]
                            );
                        }
                    }
                    ?>
                </p>

                <p>
                    TrackBack:
                    <?php
                    echo $this->Url->build(
                        [
                            'controller' => 'track-back',
                            'action' => '',
                            $post->id
                        ],
                        true
                    )
                    ?>
                </p>

                <hr>
                <p class="lead"><?= h($post->body) ?></p>
            </div>


            <?php if (!empty($post->comments)): ?>
                <table class="col-sm-7">
                    <?php foreach ($post->comments as $comments): ?>
                        <tr>
                            <td class="col-sm-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>
                                            <?= h($comments->user_name) ?>
                                        </strong>
                                <span class="text-muted">
                                    commented at
                                    <?= h($comments->created_at) ?>
                                </span>
                                    </div>
                                    <div class="panel-body">
                                        <?= h($comments->body) ?>
                                    </div>
                                </div>
                            </td>
                            <?php if ($this->request->session()->read(
                                'Auth.User'
                            )
                            ): ?>
                                <td class="col-sm-2">
                                    <?= $this->Form->postLink(
                                        __('Delete'),
                                        [
                                            'action' => 'delete_comment',
                                            $comments->id,
                                            $post->id
                                        ],
                                        [
                                            'confirm' => __(
                                                'Are you sure you want to delete # {0}?',
                                                $comments->id
                                            ),
                                            'class' => "btn btn-default btn-danger"
                                        ]
                                    ) ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>


            <div class="col-md-8">
                <div class="well well-sm">
                    <?= $this->Form->create(
                        $comment, ['action' => 'post_comment']
                    ) ?>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-3 control-label"
                                   for="name">Name</label>

                            <div class="col-md-9">
                                <?=
                                $this->Form->input(
                                    'user_name',
                                    [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'placeholder' => 'Your name'
                                    ]
                                )
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">
                                Your message
                            </label>

                            <div class="col-md-9">
                                <?=
                                $this->Form->input(
                                    'body',
                                    [
                                        'label' => false,
                                        'class' => 'form-control',
                                        'placeholder' => 'Please enter your message here...',
                                        'rows' => 5
                                    ]
                                )
                                ?>
                            </div>
                        </div>
                        <?= $this->Form->hidden(
                            'post_id', ['value' => $post->id]
                        ); ?>

                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <?=
                                $this->Form->button(
                                    __('Submit'),
                                    [
                                        'class' => 'btn btn-primary btn-lg'
                                    ]
                                )
                                ?>
                            </div>
                        </div>

                        <?= $this->Form->end() ?>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
</div>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
