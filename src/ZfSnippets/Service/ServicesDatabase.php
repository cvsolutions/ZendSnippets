<?php
namespace Boa\Service;

use Application\Model\Page;
use Application\Model\Events;
use Application\Model\Gallery;
use Zend\Http\PhpEnvironment\Request;
use Zend\Filter\File\RenameUpload;
use Zend\Validator\File\Size;

/**
 * ServicesDatabase
 *
 * @author Concetto Vecchio
 * @package Boa
 * @version 1.0
 * @category Service
 *          
 */
class ServicesDatabase
{

    /**
     * $ModelPage
     *
     * @var Page
     */
    protected $ModelPage;

    /**
     * $ModelEvents
     *
     * @var Events
     */
    protected $ModelEvents;

    /**
     * $ModelGallery
     *
     * @var Gallery
     */
    protected $ModelGallery;

    /**
     * toAscii
     *
     * @param string $str            
     * @param string $delimiter            
     * @return mixed
     */
    private function toAscii($str, $delimiter = '-')
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        return $clean;
    }

    /**
     * getSlug
     *
     * @param array $form            
     * @param int $id            
     * @return slug
     */
    private function getSlug($form, $id)
    {
        if ($id == 0) {
            return $this->toAscii($form['fullname']);
        } else {
            
            $row = $this->ModelPage->getByID($id);
            
            if ($row['slug'] == $form['slug']) {
                return $this->toAscii($form['fullname']);
            } else {
                return $form['slug'];
            }
        }
    }

    /**
     * getUpload
     *
     * @param string $picture            
     * @throws \Exception
     */
    private function getUpload($picture)
    {
        $request = new Request();
        $files = $request->getFiles();
        
        // Limit the file size to 1048576 bytes
        $validator = new Size(1048576);
        if (! $validator->isValid($files['picture'])) {
            throw new \Exception('Immagine troppo pesante, la dimensiome massima consentita e\' 1Mb!!');
        }
        
        $filter = new RenameUpload(array(
            'target' => sprintf('./public_html/uploaded/%s', $picture),
            'overwrite' => true
        ));
        $filter->filter($files['picture']);
    }

    /**
     * deleteFile
     *
     * @param string $picture            
     */
    private function deleteFile($picture)
    {
        $filename = sprintf('./public_html/uploaded/%s', $picture);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * __construct
     *
     * @param Page $page            
     * @param Events $events            
     * @param Gallery $gallery            
     */
    public function __construct(Page $page, Events $events, Gallery $gallery)
    {
        $this->ModelPage = $page;
        $this->ModelEvents = $events;
        $this->ModelGallery = $gallery;
    }

    /**
     * insert
     *
     * @param string $call            
     * @param string $table            
     * @param array $form            
     * @param int $id            
     * @param string $picture            
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function insert($call, $table, $form = array(), $id = '', $picture = '')
    {
        switch ($call) {
            
            case 'create':
                
                switch ($table) {
                    
                    case 'page':
                        $form['slug'] = $this->getSlug($form, 0);
                        return $this->ModelPage->insert($form);
                        break;
                    
                    case 'events':
                        $this->getUpload($picture);
                        return $this->ModelEvents->insert($form, $picture);
                        break;
                    
                    case 'gallery':
                        $this->getUpload($picture);
                        return $this->ModelGallery->insert($picture, $form);
                        break;
                }
                
                break;
            
            case 'modification':
                
                switch ($table) {
                    
                    case 'page':
                        $form['slug'] = $this->getSlug($form, $id);
                        return $this->ModelPage->update($id, $form);
                        break;
                    
                    case 'events':
                        $this->getUpload($picture);
                        return $this->ModelEvents->update($id, $form, $picture);
                        break;
                }
                
                break;
            
            case 'eliminates':
                
                switch ($table) {
                    
                    case 'page':
                        return $this->ModelPage->delete($id);
                        break;
                    
                    case 'events':
                        $row = $this->ModelEvents->getByID($id);
                        $this->deleteFile($row['picture']);
                        return $this->ModelEvents->delete($id);
                        break;
                    
                    case 'gallery':
                        $row = $this->ModelGallery->getByID($id);
                        $this->deleteFile($row['picture']);
                        return $this->ModelGallery->delete($id);
                        break;
                }
                
                break;
        }
    }
}
