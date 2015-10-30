<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?=
            $this->Html->link(
                'Blog Title',
                array(
                    'controller' => 'posts',
                    'action' => 'index'
                ),
                ['class' => 'navbar-brand']
            );
            ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?=
                    $this->Html->link(
                        'Blog',
                        array(
                            'controller' => 'Posts',
                            'action' => 'index',
                        )
                    );
                    ?>
                </li>
                <?php if ($this->request->session()->read('Auth.User')): ?>
                    <li>
                        <?=
                        $this->Html->link(
                            'Post',
                            array(
                                'controller' => 'Posts',
                                'action' => 'add'
                            )
                        );
                        ?>
                    </li>
                    <li>
                        <?=
                        $this->Html->link(
                            'TrackBack',
                            array(
                                'controller' => 'TrackBack',
                                'action' => 'index'
                            )
                        );
                        ?>
                    </li>
                    <li>
                        <?=
                        $this->Html->link(
                            'Sign out',
                            array(
                                'controller' => 'Users',
                                'action' => 'logout'
                            )
                        );
                        ?>
                    </li>
                <?php else: ?>
                    <li>
                        <?=
                        $this->Html->link(
                            'Sign in',
                            array(
                                'controller' => 'Users',
                                'action' => 'login'
                            )
                        );
                        ?>
                    </li>
                <?php endif; ?>
            </ul>
            <?php
            echo $this->Form->create(
                null,
                [
                    'url' => ['controller' => 'Posts', 'action' => 'index'],
                    'type' => 'get',
                    'class' => 'navbar-form navbar-right'
                ]
            );
            echo $this->Form->input(
                '',
                [
                    'type' => 'text',
                    'placeholder' => 'Search...'
                ]
            );
            echo $this->Form->end();
            ?>
        </div>
    </div>
</nav>

