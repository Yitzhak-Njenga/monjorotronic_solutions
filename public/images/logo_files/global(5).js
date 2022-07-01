// Copyright 1999-2016. Parallels IP Holdings GmbH. All Rights Reserved.
Jsw.onReady(function () {
    var settingsField = $('additionalNginx-additionalNginxSettings');
    if (null == settingsField) {
        return;
    }

    $$("head").first().insert(
        new Element("script", {type: "text/javascript", src: "/modules/htaccess-to-nginx/rewrite-conf.js"})
    );

    var htaccessField = new Element('textarea', {
        'class': 'code pul-textarea pul-textarea--size-fill',
        'name': 'htaccess',
        'id': 'htaccess',
        'rows': 6,
        'cols': 80
    });

    var convertBtn = new Element('span', {'class': 'btn action'}).insert(
        new Element('button').update('Convert to nginx')
    );
    convertBtn.observe('click', function(event) {
        Event.stop(event);
        let htaccess = htaccessField.getValue();
        let nginx = RewriteConf.convert(htaccess);
        let nativeInputValueSetter = Object.getOwnPropertyDescriptor(window.HTMLTextAreaElement.prototype, "value").set;
        nativeInputValueSetter.call(settingsField, nginx);
        let event1 = new Event('input', {bubbles: true});
        settingsField.dispatchEvent(event1);
    });

    var htaccessRow = new Element('div', {'class': 'pul-section-item pul-form-field pul-form-field-text pul-form-field-text--multiline'}).insert(
        new Element('div', {'class': 'pul-section-item__title'}).insert(
            new Element('label', {'for': 'htaccess'}).insert('.htaccess content&nbsp;')
        )
    ).insert(
        new Element('div', {'class': 'pul-section-item__value'}).insert(htaccessField)
            .insert(new Element('p', {'class': 'hint'}).update('Attention: .htaccess converter is an experimental feature. Always check conversion results for possible issues.'))
            .insert(convertBtn)
    );

    var settingsRow = settingsField.up('.pul-form-field');

    var toggleLink = new Element("a", {'href': '#', 'class': "toggler"});
    toggleLink.setStyle({'float': 'right'});
    var showLink = toggleLink.clone().update('Show .htaccess converter');
    var hideLink = toggleLink.clone().update('Hide .htaccess converter');

    var toggleFunc = function(event, show) {
        event && event.preventDefault();
        showLink.toggle(!show);
        hideLink.toggle(show);
        htaccessRow.toggle(show);
    };
    showLink.observe('click', function(event) { toggleFunc(event, true); });
    settingsRow.insert({before: showLink});
    hideLink.observe('click', function(event) { toggleFunc(event, false); });
    settingsRow.insert({before: hideLink});
    settingsRow.insert({before: new Element('div', {'class': 'clearfix'})});
    settingsRow.insert({before: htaccessRow});
    toggleFunc(null, false);
});
