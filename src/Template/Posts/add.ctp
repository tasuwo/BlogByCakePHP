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
        <div class="col-xs-8 col-xs-offset-2">
            <?= $this->Form->create($post) ?>
            <fieldset>
                <legend><?= __('Add Post') ?></legend>
                <?php
                echo $this->Form->input('title');
                echo $this->Form->input('body');
                ?>

                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="funkyradio">
                            <?php foreach ($tags as $tag): ?>
                                <div class="funkyradio-primary">
                                    <?= $this->Form->checkbox(
                                        'tags[_ids][]',
                                        [
                                            'value' => $tag->id,
                                            'id' => 'checkbox' . $tag->id,
                                        ]
                                    ) ?>
                                    <label for=<?= 'checkbox' . $tag->id ?>>
                                        <?= $tag->name ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
