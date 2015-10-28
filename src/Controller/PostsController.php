<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(
            [
                'index',
                'view',
                'postComment',
                'deleteComment'
            ]
        );
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $posts = $this->Posts->find('all')->contain(['Tags']);

        // TODO: OR検索とAND検索等，細かい検索を行えるようにする
        // TODO: 検索の処理は切り出したほうがよさげ
        if ($this->request->is('get')) {
            $query = $this->Posts->find()->contain(['Tags']);

            if (array_key_exists('criteria', $this->request->query)) {
                $criteria = $this->request->query('criteria');
                $criteria_array = explode(" ", $criteria);

                foreach ($criteria_array as $criteria) {
                    $query->orWhere(
                        [
                            'Posts.title LIKE' => '%' . $criteria . '%',
                        ]
                    );
                    // TODO: 全文検索の効率が悪そう
                    $query->orWhere(
                        [
                            'Posts.body LIKE' => '%' . $criteria . '%',
                        ]
                    );
                }
            } else {
                if (array_key_exists('tag', $this->request->query)) {
                    $criteria = $this->request->query('tag');
                    $query->matching(
                        'Tags',
                        function (\Cake\ORM\Query $q) use (&$criteria) {
                            return $q->where(['Tags.name' => $criteria]);
                        }
                    );
                }
            }
            $posts = $query->all();
        }

        // TODO: paginate
        $this->set('posts', $posts);
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     *
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentTable = TableRegistry::get('Comments');
        $comment = $commentTable->newEntity();
        $post = $this->Posts->get(
            $id, [
                'contain' => ['Tags', 'Comments']
            ]
        );
        $this->set('comment', $comment);
        $this->set(compact('post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Post comment method
     *
     * @return \Cake\Network\Response|void
     */
    public function postComment()
    {
        if ($this->request->is('post')) {
            $now = new \DateTime();

            $commentTable = TableRegistry::get('Comments');
            $comment = $commentTable->newEntity();
            $comment = $commentTable->patchEntity(
                $comment, $this->request->data
            );
            $comment->updated_at = $now->format('Y-m-d H:i:s');
            $comment->created_at = $now->format('Y-m-d H:i:s');

            if ($commentTable->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
            } else {
                $this->Flash->error(
                    __('The comment could not be saved. Please, try again.')
                );
            }
            return $this->redirect(
                [
                    'controller' => 'posts',
                    'action' => 'view',
                    $this->request->data('post_id')
                ]
            );
        }
    }

    /**
     * Delete Comment method
     *
     * @param null $comment_id
     * @param null $post_id
     *
     * @return \Cake\Network\Response|void
     */
    public function deleteComment($comment_id = null, $post_id = null)
    {
        $commentTable = TableRegistry::get('Comments');
        $comment = $commentTable->get($comment_id);
        if ($commentTable->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(
                __('The comment could not be deleted. Please, try again.')
            );
        }
        return $this->redirect(
            [
                'action' => 'view',
                $post_id
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function add()
    {
        $tagsTable = TableRegistry::get('Tags');
        $postsTagsTable = TableRegistry::get('PostsTags');

        $now = new \DateTime();

        $tags = $tagsTable->find();
        $post = $this->Posts->newEntity();

        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            $post->updated_at = $now->format('Y-m-d H:i:s');
            $post->created_at = $now->format('Y-m-d H:i:s');

            if (!$this->Posts->save($post)) {
                throw new \Exception('Failed to save post entity');
            } else {
                return $this->redirect(
                    [
                        'action' => 'view',
                        $post->id
                    ]
                );
            }
        }

        $this->set(compact('post', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     *
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tagsTable = TableRegistry::get('Tags');
        $tags = $tagsTable->find();

        $now = new \DateTime();

        $post = $this->Posts->get(
            $id,
            [
                'contain' => ['Tags']
            ]
        );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            $post->updated_at = $now->format('Y-m-d H:i:s');

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(
                    __('The post could not be saved. Please, try again.')
                );
            }
        }

        $this->set(compact('post', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     *
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(
                __('The post could not be deleted. Please, try again.')
            );
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * ajax用の関数のために echo しているので，他では使わないこと
     */
    public function ajaxAddNewTag()
    {
        if ($this->request->is('post')) {
            $new_tags_name = $this->request->data('tags_name');

            $tagsTable = TableRegistry::get('Tags');
            $new_tag = $tagsTable->newEntity(
                [
                    'name' => $new_tags_name
                ]
            );
            if (!$tagsTable->save($new_tag)) {
                echo '-1';
                exit;
            } else {
                $added_tag = $tagsTable->find()->where(
                    [
                        'name' => $new_tags_name
                    ]
                )->first();
                echo $added_tag->id;
                exit;
            }
        }
    }
}
