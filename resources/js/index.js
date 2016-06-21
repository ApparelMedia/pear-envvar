var delegate = require('delegate');
var rowHtml = require('./template/envvar-row.handlebars');
require('isomorphic-fetch');

var addRow = document.querySelector('#add-row');
var container = document.querySelector('.envvar-container');

function parseHTML(str) {
    var temp = document.implementation.createHTMLDocument('');
    temp.body.innerHTML = str;
    return temp.body.firstChild;
}

addRow.addEventListener('click', (e) => {
    e.preventDefault();
    var html = parseHTML(rowHtml())
    container.appendChild(html)
});

delegate(document.body, '.remove-row', 'click', (e) => {
    e.preventDefault();
    var row = e.delegateTarget.parentNode.parentNode;
    container.removeChild(row);
});

function setLoading(el) {
    el.className = 'fa fa-cog fa-spin fa-fw';
    el.title = 'loading';
}

function setSuccessful(el) {
   el.className = 'fa fa-check-circle icon-bg-green';
    el.title = 'connection is good!';
}

function setNotsure(el) {
    el.className = 'fa fa-circle icon-bg-gray';
    el.title = 'connection not checked';
}

function checkConnection(target, iconEl) {
    fetch('/api/connections/' + target.value + '/check')
        .then((response) => {
            if (response.status > 400) {
                setFailed(iconEl);
            }
            return response.json();
        })
        .then((json) => {
            if (target.checked && json.data.success) {
                setSuccessful(iconEl);
            }
        });
}

var checkedInputs = document.querySelectorAll('.connection:checked');

[].forEach.call(checkedInputs, (input) => {
    let iconEl = document.querySelector('#connection_icon_' + input.value);
    setLoading(iconEl);
    fetch('/api/connections/' + input.value + '/check')
        .then((response) => response.json())
        .then((json) => {
            setSuccessful(iconEl);
        });
});

delegate(document.querySelector('.connections-container'), '.connection', 'click', (e) => {
    let target = e.delegateTarget;
    let iconEl = document.querySelector('#connection_icon_' + target.value);
    if (target.checked) {
        setLoading(iconEl);
        checkConnection(target, iconEl);
    } else {
        setNotsure(iconEl);
   }
});