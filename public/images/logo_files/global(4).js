// Copyright 1999-2020. Plesk International GmbH. All rights reserved.

Jsw.namespace('PleskExt.LiteBanners');

PleskExt.LiteBanners.init = function (promoUrl) {
    promoUrl = promoUrl || 'https://go.plesk.com/upgrade/web-admin-se';

    let pageContent = document.querySelector('.page-content, .pul-layout__main-inner');
    if (!pageContent) {
        return;
    }

    let pLeft       = pageContent.getStyle('paddingLeft'),
        pRight      = pageContent.getStyle('paddingRight'),
        pTop        = pageContent.getStyle('paddingTop'),
        pathPrefix  = '/modules/lite-banners/images/',
        banners     = [
            'banner-v1',
            'banner-v2',
            'banner-v3',
        ];

    let currentBannerIndex = parseInt(Math.random() * banners.length),
        currentBanner      = banners[currentBannerIndex],
        path               = pathPrefix + currentBanner + '.png',
        link               = promoUrl + (promoUrl.indexOf('?') === -1 ? '?' : '&')
                             + 'utm_source=web-admin-se&utm_medium=referral&utm_campaign=' + currentBanner;

    pageContent.insert({
        top: '<div class="plesk-ext-notice pul-page-header" style="margin: -' + pTop + ' -' + pLeft + ' ' + pTop + ' -' + pRight + '">'+
                '<a class="plesk-ext-notice__banner" target="_blank" href="' + link + '">' +
                    '<img class="plesk-ext-notice__banner-image" src="' + path + '" alt="">' +
                '</a>' +
             '</div>'
    });
};
