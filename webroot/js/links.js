/*
* 発生箇所 : プレビューを閉じる。
* 編集 閉じる 編集 --- で発生。
*
* */

NetCommonsApp.controller('Links',
    function($scope , $http, $sce, $timeout) {

      var GET_FORM_URL = '/links/links/';
      $scope.frameId = 0;

      $scope.visibleContainer = true;

      $scope.htmlManage = '';
      $scope.visibleManage = false;

      $scope.htmlEdit = '';
      $scope.visibleEdit = false;

      $scope.htmlAddLink = '';

      $scope.initialize = function(frameId) {
        $scope.frameId = frameId;
        $scope.visibleEdit = false;
        $scope.visibleManage = false;
      };

      $scope.showContainer = function() {
          $scope.visibleContainer = true;
          $scope.visibleEdit = false;
          $scope.visibleManage = false;
      };

      $scope.showEdit = function() {
          $scope.visibleContainer = false;
          $scope.visibleEdit = true;
          $scope.visibleManage = false;
      };

      $scope.showManage = function() {
          $scope.visibleContainer = false;
          $scope.visibleEdit = false;
          $scope.visibleManage = true;
      };

      $scope.showAddLink = function() {
        $('#nc-links-modal-' + $scope.frameId).modal('show');
      };
    });
