<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('dashboard.css') ?>
    <?= $this->Html->css('checkbox.css') ?>

    <link type="text/css" rel="stylesheet"
          href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css"/>
    <script
        src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script
        src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>

    <link
        href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
        rel="stylesheet">
</head>
<body class="home">

<script>
    function sendPost(action, send_data, args) {
        return $.ajax({
            type: "POST",
            url: action,
            data: send_data,
            context: args
        })
    }

    function addTagDialog() {
        var tagDialog = $("<div></div>").dialog({autoOpen: false});
        tagDialog.html(
            "Please input new tag's name on following space."
            + '<br><br><input type="text" name="new_tag_name" id="new_tag_name"/>'
        );
        tagDialog.dialog("option", {
            title: "Add new tag",
            width: 400,
            height: 200,
            buttons: {
                "Add": function () {
                    $(this).dialog("close");

                    var new_tags_name = $("#new_tag_name").val();

                    sendPost("ajaxAddNewTag",
                        {
                            tags_name: new_tags_name
                        },
                        {
                            tags_name: new_tags_name
                        }
                    ).done(
                        function (new_tags_id) {
                            if (new_tags_id === '-1') {
                                alert('Failed to save tag');
                                return;
                            }

                            $("#tags-panel").append(
                                '<div class="col-md-3">' +
                                '<div class="funkyradio funkyradio-primary">' +
                                '<input type="checkbox" name="tags[_ids][]" value="' + new_tags_id + '" id="checkbox' + new_tags_id + '">' +
                                '<label for="checkbox' + new_tags_id + '">' +
                                new_tags_name +
                                '</label>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                    );
                },
                "Cancel": function () {
                    $(this).dialog("close");
                }
            }
        });
        tagDialog.dialog("open");
    }
</script>

<?= $this->element('header') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <br>
            <?= $this->Form->create($post) ?>
            <fieldset>
                <legend><?= __('Add Post') ?></legend>

                <?= $this->Form->input('title') ?>

                <div class="panel panel-default">
                    <div class="panel-heading">Tags</div>
                    <div class="panel-body" id="tags-panel">
                        <?php foreach ($tags as $tag): ?>
                            <div class="col-md-3">
                                <div class="funkyradio funkyradio-primary">
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
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?= $this->Form->button(
                    'New Tag',
                    [
                        'type' => 'button',
                        'class' => 'btn btn-primary',
                        'onclick' => 'addTagDialog()'
                    ]
                ) ?>

                <br><br>

                <?= $this->Form->input('body') ?>

            </fieldset>
            <?= $this->Form->button(
                __('Submit'),
                [
                    'class' => 'btn btn-primary'
                ]
            ) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
