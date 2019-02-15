/**
 *
 * @author: Enmanuel Corvo
 */
(function (setScope) {
    setScope(window.jQuery, window, document);
}(function ($, window, document) {
    wpCircleMenuProd = this.wpCircleMenuProd || {};
    $(function () {
        'use strict';
        wpCircleMenuProd = {
            init: function () {
                $.each($('.wpcm-preview-display'), function (index, item) {
                    var self = this;
                    var wpcm_pod_item = $(self).find('.wpcm-preview-menu');
                    var prodSettings = {
                        circle_radius: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-circle_radius_prod').val(),
                        direction: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-direction').val(),
                        speed: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-speed').val(),
                        step_in: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-step_in').val(),
                        step_out: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-step_out').val(),
                        transition_function: 'ease-in',
                        trigger: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-trigger').val(),
                        closedImg: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-closed_img').val(),
                        openedImg: $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-opened_img').val()
                    };
                    if (typeof($('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-transition_function').data('extra')) != 'undefined') {
                        prodSettings.transition_function_extra = $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-transition_function').data('extra');
                    }
                    wpcm_pod_item.circleMenu(prodSettings);
                    var shadowStatus = $('#' + $(wpcm_pod_item).data('wpcm-item-id') + 'wpcm-bshadow').val();
                    if (shadowStatus == '0') {
                        wpcm_pod_item.find('.wpcm-link-opener').css('box-shadow', 'none');
                    } else {
                        wpcm_pod_item.find('.wpcm-link-opener').css('box-shadow', '0 0 2px 1px #aaa')
                    }

                });
            }
        }
        wpCircleMenuProd.init();
    });
}));