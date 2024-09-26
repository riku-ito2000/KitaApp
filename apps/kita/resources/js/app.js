import './bootstrap';
import 'admin-lte';
import '@fortawesome/fontawesome-free/js/all.min.js';
import $ from 'jquery';
window.$ = $;

$(document).ready(function() {
    // PushMenu の初期化
    $('[data-widget="pushmenu"]').PushMenu();
});
