/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/myTopicFileUpload.js ***!
  \*******************************************/
//使用者上傳圖片
var topic_thumbnail_upload = document.querySelector('#topic_thumbnail_upload');
topic_thumbnail_upload.addEventListener('change', function (e) {
  save_thumbnail_file(e.target.files[0]);
});

function save_thumbnail_file(file) {
  var form_data = new FormData();
  form_data.append("thumbnail", file);
  fetch(target_url + 'team/' + team_id + '/topic/thumbnail/save', {
    method: 'POST',
    headers: {
      'Authorization': 'Bearer ' + api_token,
      'X-CSRF-TOKEN': csrf_token
    },
    body: form_data
  }).then(function (response) {
    return response.json();
  }).then(function (json) {
    // console.log(json.data);
    document.querySelector('#topic_thumbnail').src = json.data;
    topic_data['topic_thumbnail'] = json.data;
    send_data(team_id, 'edit');
    init_topic_data();
  })["catch"](function (error) {
    console.log(error);
  });
} // 使用者上傳原始文檔pdf word


var topic_doc = document.querySelector('#topic_doc');
topic_doc.addEventListener('change', function (e) {
  var files = e.target.files;
  var doc_form_data = new FormData();
  doc_form_data.append("doc", files[0]);

  if (files[0] != null) {
    save_doc_file(doc_form_data);
  }

  document.querySelector('#doc_upload_error').innerText = '';
  document.querySelector('#doc_upload_error_container').classList.add('d-none');
});

function save_doc_file(form_data) {
  fetch(target_url + 'team/' + team_id + '/topic/doc/save', {
    method: 'POST',
    headers: {
      'Authorization': 'Bearer ' + api_token,
      'X-CSRF-TOKEN': csrf_token
    },
    body: form_data
  }).then(function (response) {
    return response.json();
  }).then(function (json) {
    // console.log(json);
    document.querySelector('#doc_upload_error').innerText = '';

    if (json.success) {
      topic_data['doc_name'] = json.data.name;
      send_data(team_id, 'edit');
      init_topic_data();
      document.querySelector('#doc_upload_error_container').classList.add('d-none');
      document.querySelector('#doc_name').innerText = '';
      document.querySelector('#doc_name').innerText = '1.' + json.data.name;
    } else {
      document.querySelector('#doc_upload_error_container').classList.remove('d-none');
      document.querySelector('#doc_upload_error').innerText = json.message;
    }
  })["catch"](function (error) {
    console.log(error);
  });
}
/******/ })()
;