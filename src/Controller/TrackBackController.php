<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Xml;

class TrackBackController extends AppController
{
    private $FILE_PATH = 'webroot/xml/track_backs.xml';

    public function index()
    {
        $track_back_xml = @simplexml_load_file($this->FILE_PATH);
        if($track_back_xml) {
            $this->set(
                [
                    'hasData' => true,
                    'data' => $track_back_xml,
                    '_serialize' => ['data']
                ]
            );
        } else {
            $this->set(
                [
                    'hasData' => false
                ]
            );
        }
    }

    /**
     * TrackBack Ping を受け取る
     *
     * @param null $id
     *
     * @return \Cake\Network\Response|null
     */
    public function receiveTrackBackPing($id = null)
    {
        if ($this->request->is('post')) {
            try {
                $this->saveTrackBackPing($id);

                $xmlArray = [
                    'project' => [
                        'error' => [
                            0
                        ],
                        'message' => [
                            'TrackBack Ping is successfully received.'
                        ]
                    ]
                ];
            } catch (\Exception $e) {
                $xmlArray = [
                    'project' => [
                        'error' => [
                            1
                        ],
                        'message' => [
                            $e->getMessage()
                        ]
                    ]
                ];
            }
            $this->set(
                [
                    'data' => $xmlArray,
                    '_serialize' => ['data']
                ]
            );
        } else {
            return $this->redirect(
                [
                    'controller' => 'posts',
                    'action' => 'index'
                ]
            );
        }
    }

    /**
     * TrackBack Ping の内容を保存する
     *
     * @throws \Exception
     */
    private function saveTrackBackPing($track_back_id)
    {
        // Validation
        $required_keys = [
            "title",
            "excerpt",
            "url",
            "blog_name"
        ];
        foreach ($required_keys as $key) {
            if (!array_key_exists($key, $this->request->data)) {
                throw new \Exception('Bad args.');
            }
        }

        $xml = @simplexml_load_file($this->FILE_PATH);
        if ($xml) {
            // TODO: すでに存在する場合，ファイルに新たに要素を追加する
            $track_backs = $xml->xpath(
                './posts/post/' . $track_back_id . '/track_back'
            );
            if (count($track_backs) === 0) {
                // 新規追加
            } else {
                // 追加
            }
        } else {
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $posts_tag = $dom->appendChild($dom->createElement('posts'));
            $post_tag = $posts_tag->appendChild($dom->createElement('post'));
            $post_tag->setAttribute('id', $track_back_id);
            $track_back_tag = $post_tag->appendChild(
                $dom->createElement('track_back')
            );
            $track_back_tag->appendChild(
                $dom->createElement(
                    'title',
                    $this->request->data('title')
                )
            );
            $track_back_tag->appendChild(
                $dom->createElement(
                    'excerpt',
                    $this->request->data('excerpt')
                )
            );
            $track_back_tag->appendChild(
                $dom->createElement(
                    'url',
                    $this->request->data('url')
                )
            );
            $track_back_tag->appendChild(
                $dom->createElement(
                    'blog_name',
                    $this->request->data('blog_name')
                )
            );
            $dom->formatOutput = true;
            $dom->save($this->FILE_PATH);
        }
    }
}
