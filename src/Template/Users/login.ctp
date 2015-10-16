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
<body>

<?= $this->element('header') ?>

<div class="container" style="margin-top:30px">
    <div class="center-block" style="width: 500px">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Sign In</h3>
            </div>
            <div class="panel-body">
                <?= $this->Form->create() ?>
                <fieldset>
                    <?= $this->Form->input(
                        'mail', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'placeholder' => 'E-mail',
                            'name' => 'mail'
                        ]
                    ) ?>
                    <?= $this->Form->input(
                        'password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Password',
                            'name' => 'password'
                        ]
                    ) ?>
                    <?= $this->Form->button(
                        'Login', [
                            'class' => 'btn btn-sm btn-success'
                        ]
                    ) ?>
                    <?= $this->Form->end() ?>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
