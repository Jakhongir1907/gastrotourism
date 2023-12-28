<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 */

namespace common\modules\gallery\widgets;


use common\modules\gallery\assets\GalleryAsset;
use yii\jui\Widget;

class GalleryCKWidget extends Widget {

    public $id = 'ck';

    public $galleryList = '/gallery/gallery/list';

    public function init() {
        GalleryAsset::register(\Yii::$app->view);

        $galleryListUrl = \Yii::$app->urlManager->createUrl($this->galleryList);

        \Yii::$app->view->registerJs(<<<JS
            var gallery = function(editor) {
                var self = this;
                this.editor = editor;
                this.currentPage = 1;
                this.q = "";
                this.container = '.galleryList{$this->id}';
                this.selectButton = '.selectGallery';
                this.unselectButton = '.unselectGallery';
                this.loadMoreButton = ".loadMoreData{$this->id}";
                
                this.query = function () {
                    q = encodeURI(self.q);
                    self.currentPage = 1;
                    $.ajax({
                        type: 'GET',
                        url: "{$galleryListUrl}",
                        data: 'q=' + q + '&page=' + self.currentPage,
                        success: function(data) {
                            $(self.container).html(data);
                        }
                    });
                    
                };
                
                this.loadMore = function () {
                    q = encodeURI(self.q);
                    self.currentPage = self.currentPage + 1;
                    $.ajax({
                        type: 'GET',
                        url: "{$galleryListUrl}",
                        data: 'q=' + q + '&page=' + self.currentPage,
                        success: function(data) {
                            $(self.container).append(data);
                        }
                    });
                };
                
                this.selectAction = function () {
                    $(self.container).find(self.selectButton).off('click');
                    $(self.container).find(self.selectButton).on('click', function () {
                        var id = $(this).data('gallery-id');
                        self.editor.insertHtml('[gallery id=' + id + ' type=oval]');
                    });
                };
                
                this.render = function () {
                    self.selectAction();
                };

                this.init = function () {
                    $(self.loadMoreButton).on('click', function(e) {
                        e.preventDefault();
                        self.loadMore();
                    });
                };
                
                this.init();
                this.query();
                
                this.run = function(editor){
                    self.editor = editor;
                    this.render();
                    $('#gallerymodel{$this->id}').modal('show');
                };

            };

            document.gallery{$this->id} = new gallery();
JS
);

    }

    public function run() {


        $create_gallery_widget = CreateGalleryWidget::widget();

        echo <<<HTML
            <div class="modal fade" id="gallerymodel{$this->id}" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel{$this->id}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="galleryModalLabel{$this->id}">Gallery</h4>
                        </div>
                        <div class="modal-body row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#galleryList{$this->id}">Gallery</a></li>
                                <li style="display:none;"><a data-toggle="tab" href="#gallery_create{$this->id}">Create Gallery</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="galleryList{$this->id}">
                                    <div class="row col-md-12 col-xs-12 col-lg-12">
                                        <div class="galleryList{$this->id}">
                                                Loading....
                                        </div>
                                        <div class="row col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                            <div class="loadMoreData{$this->id}">
                                                <div href="#loadMoreData{$this->id}" class="btn btn-primary">Load More</div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="gallery_create{$this->id}">
                                    <div class="row col-md-12 col-xs-12 col-lg-12">
                                        <div class="gallery_create{$this->id}">

                                        {$create_gallery_widget}

                                        </div>
                                        <div class="row col-md-12 col-xs-12 col-lg-12 col-sm-12">
                                            <div class="loadMoreData{$this->id}">
                                                <div href="#loadMoreData{$this->id}" class="btn btn-primary">Load More</div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
HTML;


    }

}