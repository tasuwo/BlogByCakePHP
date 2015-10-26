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
                'Blog',
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
                <li>
                    <?=
                    $this->Html->link(
                        'Archive',
                        array(
                            'controller' => 'Coordinates',
                            'action' => 'create',
                        )
                    );
                    ?>
                </li>
                <li>
                    <?=
                    $this->Html->link(
                        'About',
                        array(
                            'controller' => 'Coordinates',
                            'action' => 'create',
                        )
                    );
                    ?>
                </li>
                <?php if ($this->request->session()->read('Auth.User')): ?>
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
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

