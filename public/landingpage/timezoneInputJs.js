for (var i = 0; i < document.forms.length; i++) {
    var form = document.forms[i];
    for (var j = 0; j < form.elements.length; j++) {
        var element = form.elements[j];
        if (element.type == 'hidden' && element.name == 'inf_form_xid' && element.value == '3a109e4aace4d428625cf43dd165e789') {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.id = 'timeZone';
            input.name = 'timeZone';
            input.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
            form.appendChild(input);
        }
    }
}