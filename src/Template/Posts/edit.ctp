<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('dashboard.css') ?>
    <?= $this->Html->css('checkbox.css') ?>
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
            <div class="posts form large-9 medium-8 columns content">
                <?= $this->Form->create($post) ?>
                <fieldset>
                    <legend><?= __('Edit Post') ?></legend>
                    <?php
                    echo $this->Form->input('title');
                    echo $this->Form->input('body');
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Tags</div>
                        <div class="panel-body" id="tags-panel">
                            <?php foreach ($tags as $tag): ?>

                                <?php
                                // TODO:かなり効率が悪い...
                                $hasRegistered = false;
                                foreach ($post->tags as $related_tag) {
                                    if ($related_tag->id === $tag->id) { $hasRegistered = true; }
                                }
                                ?>

                                <div class="col-md-3">
                                    <div class="funkyradio funkyradio-primary">
                                        <?= $this->Form->checkbox(
                                            'tags[_ids][]',
                                            [
                                                'value' => $tag->id,
                                                'id' => 'checkbox' . $tag->id,
                                                'checked' => $hasRegistered
                                            ]
                                        ) ?>
                                        <label for=<?= 'checkbox' . $tag->id ?>>
                                            <?= $tag->name ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </fieldset>
                <?= $this->Form->button(
                    __('Submit'),
                    ['class' => 'btn btn-primary']
                ) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <script
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
